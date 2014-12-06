<?php
/**
 * CustomRequestDetectors Utility.
 *
 * A collection of callbacks for custom RequestDetectors
 *
 * PHP 5
 *
 */

class CustomRequestDetector {

/**
 *
 * Returns true if the CakeRequest is for api
 *
 * @param CakeRequest $request The CakeRequest object
 * @return boolean
 */
	public static function isAPISubdomain(CakeRequest $request) {
		$subdomains = $request->subdomains();
		$matches = preg_grep( "/api/i" , $subdomains );
		return (count($matches) > 0);
	}

/**
 *
 * Returns true if the CakeRequest is for beta
 *
 * @param CakeRequest $request The CakeRequest object
 * @return boolean
 */
	public static function isBetaSubdomain(CakeRequest $request) {
		$subdomains = $request->subdomains();
		$matches = preg_grep( "/beta/i" , $subdomains );
		return (count($matches) > 0);
	}

/**
 *
 * Returns true if the CakeRequest is for localhost
 *
 * @param CakeRequest $request The CakeRequest object
 * @return boolean
 */
	public static function isLocalHost(CakeRequest $request) {
		$domain = $request->domain();
		$host 	= $request->host();
		if (strpos($domain, 'storyzer.localhost') !== false) {
			return true;
		}
		return false;
	}
}
