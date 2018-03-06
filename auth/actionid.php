<?php

/* OpenID implementation for ActionID https://developers.ngpvan.com/action-id */
/* Copyright 2018 Peter Karman - Released under the Apache License 2.0 */

set_include_path(get_include_path() . ':' . 'lib');

// constants
define('ACTION_ID_ENDPOINT', 'https://accounts.ngpvan.com/Home/Xrds');
define('FILESTORE_PATH', '/tmp/action-id-filestore');
define('DAYS_TTL', 7);
define('COOKIE_NAME', 'statedemocrats_auth');
define('DOMAIN_NAME', '.statedemocrats.us');


/**
 * include libs
 */
function doIncludes() {
    require_once "Auth/OpenID/Consumer.php";
    require_once "Auth/OpenID/FileStore.php";
    require_once "Auth/OpenID/SReg.php";
    require_once 'Apache_AuthTkt.php';
}


// setup
doIncludes();
if (!file_exists(FILESTORE_PATH)) {
    if (!mkdir(FILESTORE_PATH)) {
        error_log("Failed to mkdir " . FILESTORE_PATH);
    }
}


/**
 *
 *
 * @return string
 */
function get_scheme() {
    $scheme = 'http';
    if (isset($_SERVER['HTTPS']) and $_SERVER['HTTPS'] == 'on') {
        $scheme .= 's';
    }
    return $scheme;
}


/**
 *
 *
 * @return string
 */
function get_this_url() {
    return sprintf("%s://%s:%s%s",
        get_scheme(), $_SERVER['SERVER_NAME'],
        $_SERVER['SERVER_PORT'],
        $_SERVER['PHP_SELF']);
}


/**
 *
 *
 * @param unknown $sreg
 */
function set_auth_tkt($sreg) {
    $payload = $sreg;
    $auth_tkt = new Apache_AuthTkt(array(
            'conf' => getenv('AUTH_TKT_SECRET'),
            'digest_type' => 'sha256',
        )
    );
    $tkt = $auth_tkt->create_ticket(array(
            'user' => strtolower(preg_replace('/\W/', '-', $sreg['fullname'])),
        )
    );
    if (!$auth_tkt->validate_ticket($tkt)) {
        print "Error setting auth tkt: " . $auth_tkt->get_err();
        exit(0);
    }
    setcookie(COOKIE_NAME, $tkt, time()+(86400*DAYS_TTL), '/', DOMAIN_NAME, true);
}


// main
$this_url = get_this_url();
$oid_store = new Auth_OpenID_FileStore(FILESTORE_PATH);
$oid_consumer = new Auth_OpenID_Consumer($oid_store);

// finish?
if ($_SERVER['QUERY_STRING']) {
    /*
  print '<pre>';
  print_r($_SERVER['QUERY_STRING']);
  print '</pre>';
  exit(0);
  */

    // capture original redirect request url
    if ($_GET['r']) {
        setcookie('_statedems_us_orig_url', $_GET['r']);
        header('Location: ' . $this_url);
        exit(0);
    }

    $response = $oid_consumer->complete($this_url);
    if ($response->status == Auth_OpenID_CANCEL) {
        print 'Verification cancelled.';
        exit(0);
    }
    elseif ($response->status == Auth_OpenID_FAILURE) {
        print "OpenID authentication failed: " . $response->message;
        exit(0);
    }
    elseif ($response->status == Auth_OpenID_SUCCESS) {
        $openid = $response->getDisplayIdentifier();
        $esc_identity = $openid;
        $success = sprintf('You have successfully verified ' .
            '<a href="%s">%s</a> as your identity.',
            $esc_identity, $esc_identity);
        if ($response->endpoint->canonicalID) {
            $escaped_canonicalID = escape($response->endpoint->canonicalID);
            $success .= '  (XRI CanonicalID: '.$escaped_canonicalID.') ';
        }
        $sreg_resp = Auth_OpenID_SRegResponse::fromSuccessResponse($response);
        $sreg = $sreg_resp->contents();
        set_auth_tkt($sreg);

        // redirect to orignal destination, or /
        $redirect_url = $_COOKIE['_statedems_us_orig_url'];
        if (!$redirect_url) {
            $redirect_url = '/';
        }
        setcookie('_statedems_us_orig_url', 'expired', time() - 1);
        header('Location: ' . $redirect_url);
        exit(0);
    }
}
else {

    // start
    $auth_request = $oid_consumer->begin(ACTION_ID_ENDPOINT);
    if (!$auth_request) {
        print "You must log in with an <a href='https://accounts.ngpvan.com/'>ActionID</a>";
        exit(0);
    }

    $sreg_request = Auth_OpenID_SRegRequest::build(array('nickname'), array('fullname'));
    if ($sreg_request) {
        $auth_request->addExtension($sreg_request);
    }

    // OpenId 1 uses redirect
    if ($auth_request->shouldSendRedirect()) {
        $redirect_url = $auth_request->redirectURL($this_url, $this_url);
        if (Auth_OpenID::isFailure($redirect_url)) {
            print("Could not redirect to server: " . $redirect_url->message);
            exit(0);
        }
        else {
            header("Location: ".$redirect_url);
        }
    }
    else {
        // Generate form markup and render it.
        $form_id = 'openid_message';
        $form_html = $auth_request->htmlMarkup($this_url, $this_url, false, array('id' => $form_id));
        // Display an error if the form markup couldn't be generated;
        // otherwise, render the HTML.
        if (Auth_OpenID::isFailure($form_html)) {
            print("Could not redirect to server: " . $form_html->message);
            exit(0);
        }
        else {
            print $form_html;
        }
    }
}
