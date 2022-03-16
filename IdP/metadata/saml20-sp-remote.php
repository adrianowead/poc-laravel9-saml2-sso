<?php

/**
 * SAML 2.0 remote SP metadata for SimpleSAMLphp.
 *
 * See: https://simplesamlphp.org/docs/stable/simplesamlphp-reference-sp-remote
 */
$metadata['http://poc.saml.sp-a/saml2/nomeMeuSP/metadata'] = array(
    'AssertionConsumerService' => 'http://poc.saml.sp-a/saml2/nomeMeuSP/acs',
    'SingleLogoutService' => 'http://poc.saml.sp-a/saml2/nomeMeuSP/sls',

    'NameIDFormat' => 'urn:oasis:names:tc:SAML:2.0:nameid-format:persistent',
    'simplesaml.nameidattribute' => 'uid' 
);

$metadata['http://poc.saml.sp-b/saml2/meuServicoMuitoLegal2/metadata'] = array(
    'AssertionConsumerService' => 'http://poc.saml.sp-b/saml2/meuServicoMuitoLegal2/acs',
    'SingleLogoutService' => 'http://poc.saml.sp-b/saml2/meuServicoMuitoLegal2/sls',

    'NameIDFormat' => 'urn:oasis:names:tc:SAML:2.0:nameid-format:persistent',
    'simplesaml.nameidattribute' => 'uid' 
);