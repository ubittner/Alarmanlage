<?php

/**
 * @project       Alarmanlage/Alarmanlagenkonfigurator
 * @file          module.php
 * @author        Ulrich Bittner
 * @copyright     2022 Ulrich Bittner
 * @license       https://creativecommons.org/licenses/by-nc-sa/4.0/ CC BY-NC-SA 4.0
 */

/** @noinspection PhpExpressionResultUnusedInspection */
/** @noinspection PhpUnhandledExceptionInspection */
/** @noinspection PhpUnused */
declare(strict_types=1);

include_once __DIR__ . '/helper/AAK_autoload.php';

class Alarmanlagenkonfigurator extends IPSModule
{
    //Helper
    use AAK_Config;

    //Constants
    private const MODULE_NAME = 'Alarmanlagenkonfigurator';
    private const MODULE_PREFIX = 'AAK';
    private const MODULE_VERSION = '7.0-4, 30.01.2023';
    private const MODULE_CONTROL_GUID = '{B8A5067A-AFC2-3798-FEDC-BCD02A45615E}';

    public function Create()
    {
        //Never delete this line!
        parent::Create();

        ########## Properties

        //Functions
        $this->RegisterPropertyString('Note', '');

        //Repositories
        $this->RegisterPropertyString('CommandControlName', 'Ablaufsteuerung');
        $this->RegisterPropertyString('CommandControlURL', 'https://github.com/ubittner/Ablaufsteuerung');
        $this->RegisterPropertyString('AlarmCallName', 'Alarmanruf');
        $this->RegisterPropertyString('AlarmCallURL', 'https://github.com/ubittner/Alarmanruf');
        $this->RegisterPropertyString('AlarmLightName', 'Alarmbeleuchtung');
        $this->RegisterPropertyString('AlarmLightURL', 'https://github.com/ubittner/Alarmbeleuchtung');
        $this->RegisterPropertyString('AlertingName', 'Alarmierung');
        $this->RegisterPropertyString('AlertingURL', 'https://github.com/ubittner/Alarmierung');
        $this->RegisterPropertyString('AlarmProtocolName', 'Alarmprotokoll');
        $this->RegisterPropertyString('AlarmProtocolURL', 'https://github.com/ubittner/Alarmprotokoll');
        $this->RegisterPropertyString('AlarmSirenName', 'Alarmsirene');
        $this->RegisterPropertyString('AlarmSirenURL', 'https://github.com/ubittner/Alarmsirene');
        $this->RegisterPropertyString('AlarmZoneName', 'Alarmzone');
        $this->RegisterPropertyString('AlarmZoneURL', 'https://github.com/ubittner/Alarmzone');
        $this->RegisterPropertyString('BatteryDetectorName', 'Batteriemelder');
        $this->RegisterPropertyString('BatteryDetectorURL', 'https://github.com/ubittner/Batteriemelder');
        $this->RegisterPropertyString('NotificationName', 'Benachrichtigung');
        $this->RegisterPropertyString('NotificationURL', 'https://github.com/ubittner/Benachrichtigung');
        $this->RegisterPropertyString('DoorWindowStatusName', 'Fensterstatus');
        $this->RegisterPropertyString('DoorWindowStatusURL', 'https://github.com/ubittner/Fensterstatus');
        $this->RegisterPropertyString('RemoteControlName', 'Fernbedienung');
        $this->RegisterPropertyString('RemoteControlURL', 'https://github.com/ubittner/Fernbedienung');
        $this->RegisterPropertyString('MailerName', 'Mailer');
        $this->RegisterPropertyString('MailerURL', 'https://github.com/ubittner/Mailer');
        $this->RegisterPropertyString('StatusDisplayName', 'Statusanzeige');
        $this->RegisterPropertyString('StatusDisplayURL', 'https://github.com/ubittner/Statusanzeige');
        $this->RegisterPropertyString('WarningIndicatorName', 'Warnmelder');
        $this->RegisterPropertyString('WarningIndicatorURL', 'https://github.com/ubittner/Warnmelder');
        $this->RegisterPropertyString('MaintenanceModeName', 'Wartungsmodus');
        $this->RegisterPropertyString('MaintenanceURL', 'https://github.com/ubittner/Wartungsmodus');
        $this->RegisterPropertyString('CentralStatusName', 'Zentralenstatus');
        $this->RegisterPropertyString('CentralStatusURL', 'https://github.com/ubittner/Zentralenstatus');

        //Modules
        $this->RegisterPropertyBoolean('UseCommandControl', true);
        $this->RegisterPropertyBoolean('UseAlarmCall', true);
        $this->RegisterPropertyBoolean('UseAlarmLight', true);
        $this->RegisterPropertyBoolean('UseAlerting', true);
        $this->RegisterPropertyBoolean('UseAlarmProtocol', true);
        $this->RegisterPropertyBoolean('UseAlarmSiren', true);
        $this->RegisterPropertyBoolean('UseAlarmZone', true);
        $this->RegisterPropertyBoolean('UseBatteryDetector', true);
        $this->RegisterPropertyBoolean('UseNotification', true);
        $this->RegisterPropertyBoolean('UseDoorWindowStatus', true);
        $this->RegisterPropertyBoolean('UseRemoteControl', true);
        $this->RegisterPropertyBoolean('UseMailer', true);
        $this->RegisterPropertyBoolean('UseStatusDisplay', true);
        $this->RegisterPropertyBoolean('UseWarningIndicator', true);
        $this->RegisterPropertyBoolean('UseMaintenanceMode', true);
        $this->RegisterPropertyBoolean('UseCentralStatus', true);

        //Instances (unused at the moment)
        $this->RegisterPropertyBoolean('UseCommandControlInstance', true);
        $this->RegisterPropertyBoolean('UseAlarmCallInstance', true);
        $this->RegisterPropertyBoolean('UseAlarmLightInstance', true);
        $this->RegisterPropertyBoolean('UseAlertingInstance', true);
        $this->RegisterPropertyBoolean('UseAlarmProtocolInstance', true);
        $this->RegisterPropertyBoolean('UseAlarmSirenInstance', true);
        $this->RegisterPropertyBoolean('UseAlarmZoneInstance', true);
        $this->RegisterPropertyBoolean('UseBatteryDetectorInstance', true);
        $this->RegisterPropertyBoolean('UseNotificationInstance', true);
        $this->RegisterPropertyBoolean('UseDoorWindowStatusInstance', true);
        $this->RegisterPropertyBoolean('UseRemoteControlInstance', true);
        $this->RegisterPropertyBoolean('UseMailerInstance', true);
        $this->RegisterPropertyBoolean('UseStatusDisplayInstance', true);
        $this->RegisterPropertyBoolean('UseWarningIndicatorInstance', true);
        $this->RegisterPropertyBoolean('UseMaintenanceModeInstance', true);
        $this->RegisterPropertyBoolean('UseCentralStatusInstance', true);
    }

    public function ApplyChanges()
    {
        //Wait until IP-Symcon is started
        $this->RegisterMessage(0, IPS_KERNELSTARTED);

        //Never delete this line!
        parent::ApplyChanges();
    }

    public function MessageSink($TimeStamp, $SenderID, $Message, $Data)
    {
        $this->SendDebug(__FUNCTION__, $TimeStamp . ', SenderID: ' . $SenderID . ', Message: ' . $Message . ', Data: ' . print_r($Data, true), 0);
        if (!empty($Data)) {
            foreach ($Data as $key => $value) {
                $this->SendDebug(__FUNCTION__, 'Data[' . $key . '] = ' . json_encode($value), 0);
            }
        }
        if ($Message == IPS_KERNELSTARTED) {
            $this->KernelReady();
        }
    }

    #################### Public

    public function AddModules(): void
    {
        $id = IPS_GetInstanceListByModuleID(self::MODULE_CONTROL_GUID)[0];
        $this->SendDebug(__FUNCTION__, 'Module Control ID: ' . $id, 0);
        if ($id >= 1 && @IPS_ObjectExists($id)) {
            $properties = [];
            $properties[] = ['useModule' => 'UseCommandControl', 'moduleName' => 'CommandControlName', 'moduleURL' => 'CommandControlURL'];
            $properties[] = ['useModule' => 'UseAlarmCall', 'moduleName' => 'AlarmCallName', 'moduleURL' => 'AlarmCallURL'];
            $properties[] = ['useModule' => 'UseAlarmLight', 'moduleName' => 'AlarmLightName', 'moduleURL' => 'AlarmLightURL'];
            $properties[] = ['useModule' => 'UseAlerting', 'moduleName' => 'AlertingName', 'moduleURL' => 'AlertingURL'];
            $properties[] = ['useModule' => 'UseAlarmProtocol', 'moduleName' => 'AlarmProtocolName', 'moduleURL' => 'AlarmProtocolURL'];
            $properties[] = ['useModule' => 'UseAlarmSiren', 'moduleName' => 'AlarmSirenName', 'moduleURL' => 'AlarmSirenURL'];
            $properties[] = ['useModule' => 'UseAlarmZone', 'moduleName' => 'AlarmZoneName', 'moduleURL' => 'AlarmZoneURL'];
            $properties[] = ['useModule' => 'UseBatteryDetector', 'moduleName' => 'BatteryDetectorName', 'moduleURL' => 'BatteryDetectorURL'];
            $properties[] = ['useModule' => 'UseNotification', 'moduleName' => 'NotificationName', 'moduleURL' => 'NotificationURL'];
            $properties[] = ['useModule' => 'UseDoorWindowStatus', 'moduleName' => 'DoorWindowStatusName', 'moduleURL' => 'DoorWindowStatusURL'];
            $properties[] = ['useModule' => 'UseRemoteControl', 'moduleName' => 'RemoteControlName', 'moduleURL' => 'RemoteControlURL'];
            $properties[] = ['useModule' => 'UseMailer', 'moduleName' => 'MailerName', 'moduleURL' => 'MailerURL'];
            $properties[] = ['useModule' => 'UseStatusDisplay', 'moduleName' => 'StatusDisplayName', 'moduleURL' => 'StatusDisplayURL'];
            $properties[] = ['useModule' => 'UseWarningIndicator', 'moduleName' => 'WarningIndicatorName', 'moduleURL' => 'WarningIndicatorURL'];
            $properties[] = ['useModule' => 'UseMaintenanceMode', 'moduleName' => 'MaintenanceModeName', 'moduleURL' => 'MaintenanceURL'];
            $properties[] = ['useModule' => 'UseCentralStatus', 'moduleName' => 'CentralStatusName', 'moduleURL' => 'CentralStatusURL'];
            foreach ($properties as $property) {
                if ($this->ReadPropertyBoolean($property['useModule'])) {
                    //Check for existing module
                    $list = MC_GetModuleList($id);
                    $moduleName = $this->ReadPropertyString($property['moduleName']);
                    $this->SendDebug(__FUNCTION__, 'Modulname: ' . $moduleName, 0);
                    if (!in_array($moduleName, $list)) {
                        //Add module repository to module control
                        $this->SendDebug(__FUNCTION__, 'Das Modul ' . $moduleName . ' wird hinzugefügt', 0);
                        $url = $this->ReadPropertyString($property['moduleURL']);
                        $this->SendDebug(__FUNCTION__, 'URL: ' . $url, 0);
                        @MC_CreateModule($id, $url);
                    } else {
                        $this->SendDebug(__FUNCTION__, 'Das Modul ' . $moduleName . ' ist bereits vorhanden!', 0);
                    }
                }
            }
        }
    }

    #################### Private

    private function KernelReady(): void
    {
        $this->ApplyChanges();
    }
}