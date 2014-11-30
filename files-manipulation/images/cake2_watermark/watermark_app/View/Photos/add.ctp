<?php
    echo $this->Form->create('Photo', array('type' => 'file'));
    echo $this->Form->input('Photo.name');
    echo $this->Form->input('Image.0.attachment', array('type' => 'file', 'label' => 'Image'));
    echo $this->Form->input('Image.0.model', array('type' => 'hidden', 'value' => 'Photo'));
    echo $this->Form->end(__('Add'));
?>