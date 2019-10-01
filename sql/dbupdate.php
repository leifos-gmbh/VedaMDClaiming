<#1>
<?php

$map = [];

// Ausbildungsgang
$rec_ausbildung = ilAdvancedMDClaimingPlugin::createDBRecord(
	\ilVedaMDClaimingPlugin::RECORD_AUSBILDUNG,
	null,
	true,
	['crs']
);
$map[\ilVedaMDClaimingPlugin::RECORD_AUSBILDUNG] = $rec_ausbildung;

// Abschnitt
$rec_abschnitt = ilAdvancedMDClaimingPlugin::createDBRecord(
	\ilVedaMDClaimingPlugin::RECORD_ABSCHNITT,
	null,
	true,
	['exc','sess']
);
$map[\ilVedaMDClaimingPlugin::RECORD_ABSCHNITT] = $rec_abschnitt;

// write to global settings
$set = new \ilSetting(\ilVedaMDClaimingPlugin::SETTINGS_MODULE);
$set->set(\ilVedaMDClaimingPlugin::SETTINGS_RECORD_IDS, serialize($map));

?>

<#2>
<?php

$settings = new \ilSetting(\ilVedaMDClaimingPlugin::SETTINGS_MODULE);
$records = unserialize($settings->get(\ilVedaMDClaimingPlugin::SETTINGS_RECORD_IDS, serialize([])));

$map = [];

$field_gang = \ilAdvancedMDClaimingPlugin::createDBField(
	$records[\ilVedaMDClaimingPlugin::RECORD_AUSBILDUNG],
	\ilAdvancedMDFieldDefinition::TYPE_TEXT,
	\ilVedaMDClaimingPlugin::FIELD_AUSBILDUNGSGANG,
	null,
	true
);
$map[\ilVedaMDClaimingPlugin::FIELD_AUSBILDUNGSGANG] = $field_gang;

$field_zug = \ilAdvancedMDClaimingPlugin::createDBField(
	$records[\ilVedaMDClaimingPlugin::RECORD_AUSBILDUNG],
	\ilAdvancedMDFieldDefinition::TYPE_TEXT,
	\ilVedaMDClaimingPlugin::FIELD_AUSBILDUNGSZUG,
	null,
	true
);
$map[\ilVedaMDClaimingPlugin::FIELD_AUSBILDUNGSZUG] = $field_zug;

$field_abschnitt = \ilAdvancedMDClaimingPlugin::createDBField(
	$records[\ilVedaMDClaimingPlugin::RECORD_ABSCHNITT],
	\ilAdvancedMDFieldDefinition::TYPE_TEXT,
	\ilVedaMDClaimingPlugin::FIELD_AUSBILDUNGSGANGABSCHNITT,
	null,
	true
);
$map[\ilVedaMDClaimingPlugin::FIELD_AUSBILDUNGSGANGABSCHNITT] = $field_abschnitt;

$field_zugabschnitt = \ilAdvancedMDClaimingPlugin::createDBField(
	$records[\ilVedaMDClaimingPlugin::RECORD_ABSCHNITT],
	\ilAdvancedMDFieldDefinition::TYPE_TEXT,
	\ilVedaMDClaimingPlugin::FIELD_AUSBILDUNGSZUGABSCHNITT,
	null,
	true
);
$map[\ilVedaMDClaimingPlugin::FIELD_AUSBILDUNGSZUGABSCHNITT] = $field_zugabschnitt;

// write to global settings
$set = new \ilSetting(\ilVedaMDClaimingPlugin::SETTINGS_MODULE);
$set->set(\ilVedaMDClaimingPlugin::SETTINGS_FIELD_IDS, serialize($map));
?>

