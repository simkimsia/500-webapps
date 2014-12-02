<?php
App::uses('AppModel', 'Model');
$vendorPath = ROOT . DS . APP_DIR . DS . 'Vendor';
// include composer autoload
require $vendorPath . '/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

/**
 * Image Model
 *
 */
class Photo extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	public $hasMany = array(
        'Image' => array(
            'className' => 'Attachment',
            'foreignKey' => 'foreign_key',
            'conditions' => array(
                'Image.model' => 'Photo',
            ),
        ),
    );

    public function createWithAttachments($data) {
        // Sanitize your images before adding them
        $images = array();
        if (!empty($data['Image'][0])) {
            foreach ($data['Image'] as $i => $image) {
                if (is_array($data['Image'][$i])) {
                    // Force setting the `model` field to this model
                    $image['model'] = 'Image';

                    // Unset the foreign_key if the user tries to specify it
                    if (isset($image['foreign_key'])) {
                        unset($image['foreign_key']);
                    }

                    $images[] = $image;
                }
            }
        }
        $data['Image'] = $images;

        // Try to save the data using Model::saveAll()
        $this->create();
        if ($this->saveAll($data)) {
            return true;
        }

        // Throw an exception for the controller
        throw new Exception(__("This photo could not be saved. Please try again"));
    }

    public function createWatermarkWithAttachments($data) {
        // Sanitize your images before adding them
        $images = array();
        if (!empty($data['Image'][0])) {
            foreach ($data['Image'] as $i => $image) {
                if (is_array($data['Image'][$i])) {
                    // Force setting the `model` field to this model
                    $image['model'] = 'Image';

                    // Unset the foreign_key if the user tries to specify it
                    if (isset($image['foreign_key'])) {
                        unset($image['foreign_key']);
                    }

                    $images[] = $image;
                }
            }
        }
        $data['Image'] = $images;

        $tmpPath = $data['Image'][0]['attachment']['tmp_name'];

        // configure with favored image driver (gd by default)
        Image::configure(array('driver' => 'imagick'));

        $quality = 80; // quality at 80%

        // watermark the original before saving
        $thumbImg = Image::make(realpath($tmpPath));
        $thumbImg->text($data['Photo']['watermark'], 100, 200, function($font) {
            $font->file(ROOT . DS . APP_DIR . DS . WEBROOT_DIR . '/font/FuturaBook.ttf');
            $font->size(50);
            $font->color('#ffffff');
            $font->angle(0);
        });
        $thumbImg->save($tmpPath, $quality);

        // Try to save the data using Model::saveAll()
        $this->create();
        if ($this->saveAll($data)) {
            return $this->getLastSavedPhotoLink();
        }

        // Throw an exception for the controller
        throw new Exception(__("This photo could not be saved. Please try again"));
    }

    public function getLastSavedPhotoLink() {
        $id = $this->getLastInsertId();

        $rawQuery = 'SELECT CONCAT("/files/image/attachment/", a.id, "/", a.attachment) as path from attachments a inner join photos p on a.foreign_key = p.id and a.model = "Image" where p.id = ?;';
        $values = [$id];
        $db = $this->getDataSource();
        $result = $db->fetchAll($rawQuery, $values);
        if (Hash::check($result, '0.0.path')) {
            return $result[0][0]['path'];
        }
        // Throw an exception for the controller
        throw new Exception(__("Watermarked image is saved but cannot be found. Please try again"));
    }

}
