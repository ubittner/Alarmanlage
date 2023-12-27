<?php

/**
 * @project       Alarmanlage/Alarmanlagenkonfigurator/
 * @file          module.php
 * @author        Ulrich Bittner
 * @copyright     2023 Ulrich Bittner
 * @license       https://creativecommons.org/licenses/by-nc-sa/4.0/ CC BY-NC-SA 4.0
 */

/** @noinspection PhpUnhandledExceptionInspection */
/** @noinspection SpellCheckingInspection */
/** @noinspection PhpUnused */

declare(strict_types=1);

include_once __DIR__ . '/helper/AAK_autoload.php';

class AlarmanlageKonfigurator extends IPSModule
{
    //Helper
    use AAK_ConfigurationForm;

    //Constants
    private const LIBRARY_GUID = '{CEDAB842-9168-AC25-2831-BA23E069A6A3}';
    private const MODULE_GUID = '{E3ECD875-9AFF-F90B-45F8-A218572A0FAE}';
    private const MODULE_NAME = 'Alarmanlagenkonfigurator';
    private const MODULE_PREFIX = 'AAK';
    private const MODULE_VERSION = '7.0-5, 26.03.2023';
    private const MODULE_CONTROL_GUID = '{B8A5067A-AFC2-3798-FEDC-BCD02A45615E}';
    private const COMMAND_CONTROL_LIBRARY_GUID = '{0DF8D60F-8E07-8BAE-EF95-7298743FCEF6}';
    private const COMMAND_CONTROL_MODULE_GUID = '{0559B287-1052-A73E-B834-EBD9B62CB938}';
    private const UPDATE_DETECTOR_LIBRARY_GUID = '{D4EA0559-08BA-52EC-2933-E4530A2B5769}';
    private const UPDATE_DETECTOR_MODULE_GUID = '{EAC3392A-00F4-AC39-230E-34C28BAAE9B3}';
    private const ALARM_CALL_LIBRARY_GUID = '{5EF26FF6-6DD0-C972-1F7A-BC3CBA516042}';
    private const ALARM_CALL_MODULE_GUID = '{FA8543F8-C672-8E9F-A5A9-90103612EBFA}';
    private const ALARM_CALL_NEXXT_MOBILE_MODULE_GUID = '{CCCE18B9-245A-900F-5DCF-CF11527571CE}';
    private const ALARM_CALL_VOIP_MODULE_GUID = '{87E8FFF5-2E89-8C9E-3345-9A09D159E4B2}';
    private const ALARM_LIGHT_LIBRARY_GUID = '{71FE24C0-4A75-D30F-0D64-CED273B58600}';
    private const ALARM_LIGHT_MODULE_GUID = '{15AC1D3E-06CC-0ECE-275A-914A0632DF58}';
    private const ALERTING_LIBRARY_GUID = '{9D16FD4F-37AA-96D0-EC29-8203B09156B2}';
    private const ALERTING_MODULE_GUID = '{2470D8A2-135B-98CA-6A89-70A18DC46CAE}';
    private const ALARM_PROTOCOL_LIBRARY_GUID = '{60C35BE7-ED7C-AD82-EFCA-8B2AD23579F6}';
    private const ALARM_PROTOCOL_MODULE_GUID = '{66BDB59B-E80F-E837-6640-005C32D5FC24}';
    private const ALARM_SIREN_LIBRARY_GUID = '{FAA4CD97-9BA5-6415-C57C-EB2BD5B1E143}';
    private const ALARM_SIREN_MODULE_GUID = '{72CC55F4-4A05-D3A4-AEFB-1B1E2C0EAF14}';
    private const ALARM_SIREN_HOMEMATIC_MODULE_GUID = '{90C71DCF-603A-A5C8-7955-CB3FFC4FF58C}';
    private const ALARM_SIREN_HOMEMATICIP_MODULE_GUID = '{C2E1BF4E-FB45-9023-85F0-5C80BCE99D45}';
    private const ALARM_ZONE_LIBRARY_GUID = '{F227BA9C-8112-3B9F-1149-9B53E10D4F79}';
    private const ALARM_ZONE_MODULE_GUID = '{127AB08D-CD10-801D-D419-442CDE6E5C61}';
    private const ALARM_ZONE_CONTROL_MODULE_GUID = '{79BB840E-65C1-06E0-E1DD-BAFEFC514848}';
    private const BATTERY_DETECTOR_LIBRARY_GUID = '{30910CF9-AC0D-A48F-267D-24CE177C6B8C}';
    private const BATTERY_DETECTOR_MODULE_GUID = '{3C878C9D-63E0-767D-494C-35AC950EA76D}';
    private const NOTIFICATION_LIBRARY_GUID = '{76D34084-7695-02EF-DAA8-82041E08AB72}';
    private const NOTIFICATION_MODULE_GUID = '{BDAB70AA-B45D-4CB4-3D65-509CFF0969F9}';
    private const REMOTE_CONTROL_LIBRARY_GUID = '{B98CAD42-EF00-5277-BB1C-0760EA2AD0C4}';
    private const REMOTE_CONTROL_MODULE_GUID = '{73F6BEB3-115F-4018-A1D3-C6C16B939986}';
    private const MAILER_LIBRARY_GUID = '{9B229E71-4D0F-E386-330F-1AC86B01BE18}';
    private const MAILER_MODULE_GUID = '{C6CF3C5C-E97B-97AB-ADA2-E834976C6A92}';
    private const STATUS_DISPLAY_LIBRARY_GUID = '{3E8B8394-FC34-8C9A-6324-A03FB7E64B29}';
    private const STATUS_DISPLAY_MODULE_GUID = '{A059E898-5F10-F396-1886-3FB86DC92DD3}';
    private const STATUS_DISPLAY_HOMEMATIC_MODULE_GUID = '{17C9B00D-3C66-2B99-7F83-604DA32C91E6}';
    private const STATUS_DISPLAY_HOMEMATICIP_MODULE_GUID = '{B811C5C6-4DB9-2E1E-D8F8-1532D1A2CFCD}';
    private const STATUS_LIST_LIBRARY_GUID = '{7970AD78-5D4E-9DF8-6B05-089B56F4D608}';
    private const STATUS_LIST_MODULE_GUID = '{FCC297AA-0414-29FD-DD5E-3A48514D7D4E}';
    private const MAINTENANCE_MODE_LIBRARY_GUID = '{A2FDCE6D-C181-9B29-638D-FEB803E5DEA0}';
    private const MAINTENANCE_MODE_MODULE_GUID = '{EA65A9F4-68CA-7891-E4B7-34E24B7A4745}';
    private const WARNING_INDICATOR_LIBRARY_GUID = '{70D8F340-4128-EEC8-3FCE-5C3FA449B64F}';
    private const WARNING_INDICATOR_MODULE_GUID = '{D2516F46-D422-3393-ABF6-2ACF5CA7070B}';
    private const CENTRAL_STATUS_LIBRARY_GUID = '{E095D925-0603-3299-3534-EF11FC14E13E}';
    private const CENTRAL_STATUS_MODULE_GUID = '{2ED87E59-10F7-2B7E-827E-70BB637E2856}';

    public function Create()
    {
        //Never delete this line!
        parent::Create();

        ########## Properties

        //Info
        $this->RegisterPropertyString('Note', '');

        //Repositories
        $this->RegisterPropertyString('CommandControlURL', 'https://github.com/ubittner/Ablaufsteuerung');
        $this->RegisterPropertyString('UpdateDetectorURL', 'https://github.com/ubittner/Aktualisierungsmelder');
        $this->RegisterPropertyString('AlarmCallURL', 'https://github.com/ubittner/Alarmanruf');
        $this->RegisterPropertyString('AlarmLightURL', 'https://github.com/ubittner/Alarmbeleuchtung');
        $this->RegisterPropertyString('AlertingURL', 'https://github.com/ubittner/Alarmierung');
        $this->RegisterPropertyString('AlarmProtocolURL', 'https://github.com/ubittner/Alarmprotokoll');
        $this->RegisterPropertyString('AlarmSirenURL', 'https://github.com/ubittner/Alarmsirene');
        $this->RegisterPropertyString('AlarmZoneURL', 'https://github.com/ubittner/Alarmzone');
        $this->RegisterPropertyString('BatteryDetectorURL', 'https://github.com/ubittner/Batteriemelder');
        $this->RegisterPropertyString('NotificationURL', 'https://github.com/ubittner/Benachrichtigung');
        $this->RegisterPropertyString('RemoteControlURL', 'https://github.com/ubittner/Fernbedienung');
        $this->RegisterPropertyString('MailerURL', 'https://github.com/ubittner/Mailer');
        $this->RegisterPropertyString('StatusDisplayURL', 'https://github.com/ubittner/Statusanzeige');
        $this->RegisterPropertyString('StatusListURL', 'https://github.com/ubittner/Statusliste');
        $this->RegisterPropertyString('MaintenanceModeURL', 'https://github.com/ubittner/Wartungsmodus');
        $this->RegisterPropertyString('WarningIndicatorURL', 'https://github.com/ubittner/Warnmelder');
        $this->RegisterPropertyString('CentralStatusURL', 'https://github.com/ubittner/Zentralenstatus');
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

    public function UIShowMessage(string $Message): void
    {
        $this->UpdateFormField('InfoMessage', 'visible', true);
        $this->UpdateFormField('InfoMessageLabel', 'caption', $Message);
    }

    public function UpdateField(string $Name, string $Parameter, string $Value): void
    {
        if ($Value == 0) {
            return;
        }
        $this->UpdateFormField($Name, $Parameter, $Value);
    }

    public function AddLibrary(string $LibraryName): void
    {
        $library['CommandControl'] = ['GUID' => self::COMMAND_CONTROL_LIBRARY_GUID, 'moduleName' => 'Ablaufsteuerung', 'URL' => 'CommandControlURL'];
        $library['UpdateDetector'] = ['GUID' => self::UPDATE_DETECTOR_LIBRARY_GUID, 'moduleName' => 'Aktualisierungsmelder', 'URL' => 'UpdateDetectorURL'];
        $library['AlarmCall'] = ['GUID' => self::ALARM_CALL_LIBRARY_GUID, 'moduleName' => 'Alarmanruf', 'URL' => 'AlarmCallURL'];
        $library['AlarmLight'] = ['GUID' => self::ALARM_LIGHT_LIBRARY_GUID, 'moduleName' => 'Alarmbeleuchtung', 'URL' => 'AlarmLightURL'];
        $library['Alerting'] = ['GUID' => self::ALERTING_LIBRARY_GUID, 'moduleName' => 'Alarmierung', 'URL' => 'AlertingURL'];
        $library['AlarmProtocol'] = ['GUID' => self::ALARM_PROTOCOL_LIBRARY_GUID, 'moduleName' => 'Alarmprotokoll', 'URL' => 'AlarmProtocolURL'];
        $library['AlarmSiren'] = ['GUID' => self::ALARM_SIREN_LIBRARY_GUID, 'moduleName' => 'Alarmsirene', 'URL' => 'AlarmSirenURL'];
        $library['AlarmZone'] = ['GUID' => self::ALARM_ZONE_LIBRARY_GUID, 'moduleName' => 'Alarmzone', 'URL' => 'AlarmZoneURL'];
        $library['BatteryDetector'] = ['GUID' => self::BATTERY_DETECTOR_LIBRARY_GUID, 'moduleName' => 'Batteriemelder', 'URL' => 'BatteryDetectorURL'];
        $library['Notification'] = ['GUID' => self::NOTIFICATION_LIBRARY_GUID, 'moduleName' => 'Benachrichtigung', 'URL' => 'NotificationURL'];
        $library['RemoteControl'] = ['GUID' => self::REMOTE_CONTROL_LIBRARY_GUID, 'moduleName' => 'Fernbedienung', 'URL' => 'RemoteControlURL'];
        $library['Mailer'] = ['GUID' => self::MAILER_LIBRARY_GUID, 'moduleName' => 'Mailer', 'URL' => 'MailerURL'];
        $library['StatusDisplay'] = ['GUID' => self::STATUS_DISPLAY_LIBRARY_GUID, 'moduleName' => 'Statusanzeige', 'URL' => 'StatusDisplayURL'];
        $library['StatusList'] = ['GUID' => self::STATUS_LIST_LIBRARY_GUID, 'moduleName' => 'Statusliste', 'URL' => 'StatusListURL'];
        $library['MaintenanceMode'] = ['GUID' => self::MAINTENANCE_MODE_LIBRARY_GUID, 'moduleName' => 'Wartungsmodus', 'URL' => 'MaintenanceModeURL'];
        $library['WarningIndicator'] = ['GUID' => self::WARNING_INDICATOR_LIBRARY_GUID, 'moduleName' => 'Warnmelder', 'URL' => 'WarningIndicatorURL'];
        $library['CentralStatus'] = ['GUID' => self::CENTRAL_STATUS_LIBRARY_GUID, 'moduleName' => 'Zentralenstatus', 'URL' => 'CentralStatusURL'];
        $name = $library[$LibraryName]['moduleName'];
        $this->SendDebug(__FUNCTION__, $LibraryName . ' = ' . $name, 0);
        if (IPS_LibraryExists($library[$LibraryName]['GUID'])) {
            $message = 'Abbruch: Bibliothek ' . $name . ' existiert bereits!';
            $this->UpdateFormField('PopupProgressBar', 'visible', false);
            $this->UpdateFormField('PopupMessage', 'caption', $message);
            $this->UpdateFormField('PopupAlert', 'visible', true);
        } else {
            $id = IPS_GetInstanceListByModuleID(self::MODULE_CONTROL_GUID)[0];
            if ($id >= 1 && @IPS_ObjectExists($id)) {
                $this->UpdateFormField('PopupProgressBar', 'caption', $name);
                $this->UpdateFormField('PopupProgressBar', 'visible', true);
                $this->UpdateFormField('PopupAlert', 'visible', true);
                $result = @MC_CreateModule($id, $this->ReadPropertyString($library[$LibraryName]['URL']));
                $this->UpdateFormField('PopupProgressBar', 'visible', false);
                $message = 'Fehler: Bibliothek ' . $name . ' konnte nicht hinzugefügt werden!';
                if ($result) {
                    $this->UpdateFormField('Add' . $LibraryName . 'LibraryButton', 'enabled', false);
                    $this->UpdateFormField('Select' . $LibraryName . 'Module', 'visible', true);
                    $this->UpdateFormField('Create' . $LibraryName . 'InstanceButton', 'visible', true);
                    $this->UpdateFormField('Select' . $LibraryName . 'Instance', 'visible', true);
                    $message = 'Bibliothek ' . $name . ' wurde erfolgreich hinzugefügt!';
                }
                $this->UpdateFormField('PopupMessage', 'caption', $message);
            }
        }
    }

    public function CreateInstance(string $ModuleGUID, int $CategoryID): void
    {
        $module[self::COMMAND_CONTROL_MODULE_GUID] = ['moduleName' => 'Ablaufsteuerung', 'actionName' => 'CommandControl'];
        $module[self::UPDATE_DETECTOR_MODULE_GUID] = ['moduleName' => 'Aktualisierungsmelder', 'actionName' => 'UpdateDetector'];
        $module[self::ALARM_CALL_MODULE_GUID] = ['moduleName' => 'Alarmanruf', 'actionName' => 'AlarmCall'];
        $module[self::ALARM_CALL_NEXXT_MOBILE_MODULE_GUID] = ['moduleName' => 'Alarmanruf NeXXt Mobile', 'actionName' => 'AlarmCall'];
        $module[self::ALARM_CALL_VOIP_MODULE_GUID] = ['moduleName' => 'Alarmanruf VoIP', 'actionName' => 'AlarmCall'];
        $module[self::ALARM_LIGHT_MODULE_GUID] = ['moduleName' => 'Alarmbeleuchtung', 'actionName' => 'AlarmLight'];
        $module[self::ALERTING_MODULE_GUID] = ['moduleName' => 'Alarmierung', 'actionName' => 'Alerting'];
        $module[self::ALARM_PROTOCOL_MODULE_GUID] = ['moduleName' => 'Alarmprotokoll', 'actionName' => 'AlarmProtocol'];
        $module[self::ALARM_SIREN_MODULE_GUID] = ['moduleName' => 'Alarmsirene', 'actionName' => 'AlarmSiren'];
        $module[self::ALARM_SIREN_HOMEMATIC_MODULE_GUID] = ['moduleName' => 'Alarmsirene Homematic', 'actionName' => 'AlarmSiren'];
        $module[self::ALARM_SIREN_HOMEMATICIP_MODULE_GUID] = ['moduleName' => 'Alarmsirene Homematic IP', 'actionName' => 'AlarmSiren'];
        $module[self::ALARM_ZONE_MODULE_GUID] = ['moduleName' => 'Alarmzone', 'actionName' => 'AlarmZone'];
        $module[self::ALARM_ZONE_CONTROL_MODULE_GUID] = ['moduleName' => 'Alarmzone', 'actionName' => 'AlarmZone'];
        $module[self::BATTERY_DETECTOR_MODULE_GUID] = ['moduleName' => 'Batteriemelder', 'actionName' => 'BatteryDetector'];
        $module[self::NOTIFICATION_MODULE_GUID] = ['moduleName' => 'Benachrichtigung', 'actionName' => 'Notification'];
        $module[self::REMOTE_CONTROL_MODULE_GUID] = ['moduleName' => 'Fernbedienung', 'actionName' => 'RemoteControl'];
        $module[self::MAILER_MODULE_GUID] = ['moduleName' => 'Mailer', 'actionName' => 'Mailer'];
        $module[self::STATUS_DISPLAY_MODULE_GUID] = ['moduleName' => 'Statusanzeige', 'actionName' => 'StatusDisplay'];
        $module[self::STATUS_DISPLAY_HOMEMATIC_MODULE_GUID] = ['moduleName' => 'Statusanzeige Homematic', 'actionName' => 'StatusDisplay'];
        $module[self::STATUS_DISPLAY_HOMEMATICIP_MODULE_GUID] = ['moduleName' => 'Statusanzeige Homematic IP', 'actionName' => 'StatusDisplay'];
        $module[self::STATUS_LIST_MODULE_GUID] = ['moduleName' => 'Statusliste', 'actionName' => 'StatusList'];
        $module[self::MAINTENANCE_MODE_MODULE_GUID] = ['moduleName' => 'Wartungsmodus', 'actionName' => 'MaintenanceMode'];
        $module[self::WARNING_INDICATOR_MODULE_GUID] = ['moduleName' => 'Warnmelder', 'actionName' => 'WarningIndicator'];
        $module[self::CENTRAL_STATUS_MODULE_GUID] = ['moduleName' => 'Zentralenstatus', 'actionName' => 'CentralStatus'];
        $name = $module[$ModuleGUID]['moduleName'];
        $actionName = $module[$ModuleGUID]['actionName'];
        $this->SendDebug(__FUNCTION__, $ModuleGUID . ' = ' . $name, 0);
        $id = @IPS_CreateInstance($ModuleGUID);
        if (is_int($id)) {
            IPS_SetName($id, $name);
            IPS_SetParent($id, $CategoryID);
            $this->UpdateFormField('Add' . $actionName . 'LibraryButton', 'enabled', false);
            $this->UpdateFormField('Create' . $actionName . 'InstanceButton', 'enabled', true);
            $this->UpdateFormField('Select' . $actionName . 'Module', 'enabled', true);
            $message = 'Instanz ' . $name . ' mit der ID ' . $id . ' wurde erfolgreich erstellt!';
        } else {
            $message = 'Instanz ' . $name . ' konnte nicht erstellt werden!';
        }
        $this->UpdateFormField('PopupMessage', 'caption', $message);
        $this->UpdateFormField('PopupAlert', 'visible', true);
    }

    #################### Private

    private function KernelReady(): void
    {
        $this->ApplyChanges();
    }
}