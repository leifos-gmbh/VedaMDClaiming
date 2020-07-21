<?php
/* Copyright (c) 1998-2009 ILIAS open source, Extended GPL, see docs/LICENSE */

/**
 * Class ilVedaMDClaimingPlugin
 * @author Stefan Meyer <smeyer.ilias@gmx.de>
 */
class ilVedaMDClaimingPlugin extends \ilAdvancedMDClaimingPlugin
{
	/**
	 * @var null | \ilAdvancedMDClaimingPlugin
	 */
	public static $instance = null;

    /**
     * @var string
     */
	public const PLUGIN_ID = 'vedaclaiming';

	/**
	 * @var string
	 */
	public const PLUGIN_NAME = 'VedaMDClaiming';

	/**
	 * @var string
	 */
	public const SETTINGS_MODULE = 'vedaclaiming';


	/**
	 * @var string
	 */
	public const SETTINGS_RECORD_IDS = 'records';


	/**
	 * @var string
	 */
	public const SETTINGS_FIELD_IDS = 'fields';

	/**
	 * @var string
	 */
	public const RECORD_AUSBILDUNG = 'Sifa-Ausbildung';

	/**
	 * @var string
	 */
	public const RECORD_ABSCHNITT = 'Sifa-Abschnitt';

	/**
	 * @var string
	 */
	public const FIELD_AUSBILDUNGSGANG = 'Ausbildungsgang-ID';

	/**
	 * @var string
	 */
	public const FIELD_AUSBILDUNGSZUG = 'Ausbildungszug-ID';

	/**
	 * @var string
	 */
	public const FIELD_AUSBILDUNGSGANGABSCHNITT = 'Ausbildungsgangabschitt-ID';

	/**
	 * @var string
	 */
	public const FIELD_AUSBILDUNGSZUGABSCHNITT = 'Ausbildungszugabschnitt-ID';


	/**
	 * @var null | \ilLogger
	 */
	private $logger = null;

	/**
	 * @var null | \ilSetting
	 */
	private $settings = null;

	/**
	 * @var array
	 */
	private $records = [];

	/**
	 * @var array
	 */
	private $fields = [];



	/**
	 * @return \ilVedaMDClaimingPlugin
	 */
	public static function getInstance() : \ilVedaMDClaimingPlugin
	{
		if(!self::$instance instanceof \ilVedaMDClaimingPlugin) {
			self::$instance = \ilPluginAdmin::getPluginObject(
				IL_COMP_SERVICE,
				'AdvancedMetaData',
				'amdc',
				self::PLUGIN_NAME
			);
		}
		return self::$instance;
	}

	/**
	 * init plugin (records and fields)
	 */
	public function init()
	{
		$this->settings = new \ilSetting(self::SETTINGS_MODULE);
		$this->records = unserialize($this->settings->get(self::SETTINGS_RECORD_IDS, serialize([])));
		$this->fields = unserialize($this->settings->get(self::SETTINGS_FIELD_IDS, serialize([])));

		$this->logger = \ilLoggerFactory::getLogger(self::PLUGIN_ID);
	}


	/**
	 * @return array
	 */
	public function getFields() : array
	{
		return $this->fields;
	}


	/**
	 * @inheritdoc
	 */
	public function checkPermission($a_user_id, $a_context_type, $a_context_id, $a_action_id, $a_action_sub_id) : bool
	{
		$this->logger->debug(
			$a_context_type .' ' . $a_context_id . ' ' . $a_action_id . ' ' . $a_action_sub_id
		);
		return true;
	}

	/**
	 * @inheritdoc
	 */
	public function getPluginName() : string
	{
		return self::PLUGIN_NAME;
	}
}