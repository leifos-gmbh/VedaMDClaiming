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
	public static ?ilAdvancedMDClaimingPlugin $instance = null;

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


	private ?ilLogger $logger = null;

	private ?ilSetting $settings = null;

	private array $records = [];

	private array $fields = [];



	/**
	 * @return \ilVedaMDClaimingPlugin
	 */
	public static function getInstance() : ilVedaMDClaimingPlugin
	{
        global $DIC;

        if (self::$instance instanceof self) {
            return self::$instance;
        }
        return self::$instance = new self(
            $DIC->database(),
            $DIC["component.repository"],
            self::PLUGIN_ID
        );
    }

	/**
	 * init plugin (records and fields)
	 */
	protected function init(): void
	{
		$this->settings = new \ilSetting(self::SETTINGS_MODULE);
		$this->records = unserialize($this->settings->get(self::SETTINGS_RECORD_IDS, serialize([])));
		$this->fields = unserialize($this->settings->get(self::SETTINGS_FIELD_IDS, serialize([])));

		$this->logger = \ilLoggerFactory::getLogger(self::PLUGIN_ID);
	}


	public function getFields() : array
	{
		return $this->fields;
	}


	/**
	 * @inheritdoc
	 */
	public function checkPermission(int $a_user_id, int $a_context_type, int $a_context_id, int $a_action_id, int $a_action_sub_id) : bool
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