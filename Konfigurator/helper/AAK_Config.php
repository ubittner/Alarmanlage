<?php

/**
 * @project       Alarmanlage/Alarmanlagenkonfigurator
 * @file          AAK_Config.php
 * @author        Ulrich Bittner
 * @copyright     2022 Ulrich Bittner
 * @license       https://creativecommons.org/licenses/by-nc-sa/4.0/ CC BY-NC-SA 4.0
 */

/** @noinspection PhpUnused */

declare(strict_types=1);

trait AAK_Config
{
    /**
     * Gets the configuration form.
     *
     * @return false|string
     * @throws Exception
     */
    public function GetConfigurationForm()
    {
        $form = [];

        ########## Elements

        //Info
        $form['elements'][0] = [
            'type'    => 'ExpansionPanel',
            'caption' => 'Info',
            'items'   => [
                [
                    'type'    => 'Label',
                    'name'    => 'ModuleID',
                    'caption' => "ID:\t\t\t" . $this->InstanceID
                ],
                [
                    'type'    => 'Label',
                    'name'    => 'ModuleDesignation',
                    'caption' => "Modul:\t\t" . self::MODULE_NAME
                ],
                [
                    'type'    => 'Label',
                    'name'    => 'ModulePrefix',
                    'caption' => "Präfix:\t\t" . self::MODULE_PREFIX
                ],
                [
                    'type'    => 'Label',
                    'name'    => 'ModuleVersion',
                    'caption' => "Version:\t\t" . self::MODULE_VERSION
                ],
                [
                    'type'    => 'Label',
                    'caption' => ' '
                ],
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'Note',
                    'caption' => 'Notiz',
                    'width'   => '600px'
                ]
            ]
        ];

        $form['elements'][] = [
            'type'    => 'ExpansionPanel',
            'caption' => 'Repositories',
            'items'   => [
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'CommandControlName',
                    'caption' => 'Ablaufsteuerung Modulname',
                    'width'   => '600px'
                ],
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'CommandControlURL',
                    'caption' => 'Ablaufsteuerung URL',
                    'width'   => '600px'
                ],
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'AlarmCallName',
                    'caption' => 'Alarmanruf Modulname',
                    'width'   => '600px'
                ],
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'AlarmCallURL',
                    'caption' => 'Alarmanruf URL',
                    'width'   => '600px'
                ],
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'AlarmLightName',
                    'caption' => 'Alarmbeleuchtung Modulname',
                    'width'   => '600px'
                ],
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'AlarmLightURL',
                    'caption' => 'Alarmbeleuchtung URL',
                    'width'   => '600px'
                ],
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'AlertingName',
                    'caption' => 'Alarmierung Modulname',
                    'width'   => '600px'
                ],
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'AlertingURL',
                    'caption' => 'Alarmierung URL',
                    'width'   => '600px'
                ],
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'AlarmProtocolName',
                    'caption' => 'Alarmprotokoll Modulname',
                    'width'   => '600px'
                ],
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'AlarmProtocolURL',
                    'caption' => 'Alarmprotokoll URL',
                    'width'   => '600px'
                ],
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'AlarmSirenName',
                    'caption' => 'Alarmsirene Modulname',
                    'width'   => '600px'
                ],
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'AlarmSirenURL',
                    'caption' => 'Alarmsirene URL',
                    'width'   => '600px'
                ],
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'AlarmZoneName',
                    'caption' => 'Alarmzone Modulname',
                    'width'   => '600px'
                ],
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'AlarmZoneURL',
                    'caption' => 'Alarmzone URL',
                    'width'   => '600px'
                ],
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'BatteryDetectorName',
                    'caption' => 'Batteriemelder Modulname',
                    'width'   => '600px'
                ],
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'BatteryDetectorURL',
                    'caption' => 'Batteriemelder URL',
                    'width'   => '600px'
                ],
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'NotificationName',
                    'caption' => 'Benachrichtigung Modulname',
                    'width'   => '600px'
                ],
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'NotificationURL',
                    'caption' => 'Benachrichtigung URL',
                    'width'   => '600px'
                ],
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'DoorWindowStatusName',
                    'caption' => 'Fensterstatus Modulname',
                    'width'   => '600px'
                ],
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'DoorWindowStatusURL',
                    'caption' => 'Fensterstatus URL',
                    'width'   => '600px'
                ],
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'RemoteControlName',
                    'caption' => 'Fernbedienung Modulname',
                    'width'   => '600px'
                ],
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'RemoteControlURL',
                    'caption' => 'Fernbedienung URL',
                    'width'   => '600px'
                ],
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'MailerName',
                    'caption' => 'Mailer Modulname',
                    'width'   => '600px'
                ],
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'MailerURL',
                    'caption' => 'Mailer URL',
                    'width'   => '600px'
                ],
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'StatusDisplayName',
                    'caption' => 'Statusanzeige Modulname',
                    'width'   => '600px'
                ],
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'StatusDisplayURL',
                    'caption' => 'Statusanzeige URL',
                    'width'   => '600px'
                ],
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'MaintenanceModeName',
                    'caption' => 'Wartungsmodus Modulname',
                    'width'   => '600px'
                ],
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'MaintenanceURL',
                    'caption' => 'Wartungsmodus URL',
                    'width'   => '600px'
                ],
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'CentralStatusName',
                    'caption' => 'Zentralenstatus Modulname',
                    'width'   => '600px'
                ],
                [
                    'type'    => 'ValidationTextBox',
                    'name'    => 'CentralStatusURL',
                    'caption' => 'Zentralenstatus URL',
                    'width'   => '600px'
                ]
            ]
        ];

        $form['elements'][] = [
            'type'    => 'ExpansionPanel',
            'caption' => 'Module',
            'items'   => [
                [
                    'type'    => 'CheckBox',
                    'name'    => 'UseCommandControl',
                    'caption' => 'Ablaufsteuerung'
                ],
                [
                    'type'    => 'CheckBox',
                    'name'    => 'UseAlarmCall',
                    'caption' => 'Alarmanruf'
                ],
                [
                    'type'    => 'CheckBox',
                    'name'    => 'UseAlarmLight',
                    'caption' => 'Alarmbeleuchtung'
                ],
                [
                    'type'    => 'CheckBox',
                    'name'    => 'UseAlerting',
                    'caption' => 'Alarmierung'
                ],
                [
                    'type'    => 'CheckBox',
                    'name'    => 'UseAlarmProtocol',
                    'caption' => 'Alarmprotokoll'
                ],
                [
                    'type'    => 'CheckBox',
                    'name'    => 'UseAlarmSiren',
                    'caption' => 'Alarmsirene'
                ],
                [
                    'type'    => 'CheckBox',
                    'name'    => 'UseAlarmZone',
                    'caption' => 'Alarmzone'
                ],
                [
                    'type'    => 'CheckBox',
                    'name'    => 'UseBatteryDetector',
                    'caption' => 'Batteriemelder'
                ],
                [
                    'type'    => 'CheckBox',
                    'name'    => 'UseNotification',
                    'caption' => 'Benachrichtigung'
                ],
                [
                    'type'    => 'CheckBox',
                    'name'    => 'UseDoorWindowStatus',
                    'caption' => 'Fensterstatus'
                ],
                [
                    'type'    => 'CheckBox',
                    'name'    => 'UseRemoteControl',
                    'caption' => 'Fernbedienung'
                ],
                [
                    'type'    => 'CheckBox',
                    'name'    => 'UseMailer',
                    'caption' => 'Mailer'
                ],
                [
                    'type'    => 'CheckBox',
                    'name'    => 'UseStatusDisplay',
                    'caption' => 'Statusanzeige'
                ],
                [
                    'type'    => 'CheckBox',
                    'name'    => 'UseMaintenanceMode',
                    'caption' => 'Wartungsmodus'
                ],
                [
                    'type'    => 'CheckBox',
                    'name'    => 'UseCentralStatus',
                    'caption' => 'Zentralenstatus'
                ],
                [
                    'type'    => 'Label',
                    'caption' => ' '
                ],
                [
                    'type'    => 'Button',
                    'caption' => 'Hinzufügen',
                    'onClick' => self::MODULE_PREFIX . '_AddModules($id);',
                    'visible' => true
                ]
            ]
        ];

        ########## Actions

        $form['actions'][] = [
            'type'    => 'ExpansionPanel',
            'caption' => 'Konfiguration',
            'items'   => [
                [
                    'type'    => 'Button',
                    'caption' => 'Neu laden',
                    'onClick' => self::MODULE_PREFIX . '_ReloadConfig($id);'
                ]
            ]
        ];

        //Registered messages
        $registeredMessages = [];
        $messages = $this->GetMessageList();
        foreach ($messages as $id => $messageID) {
            $name = 'Objekt #' . $id . ' existiert nicht';
            $rowColor = '#FFC0C0'; //red
            if (@IPS_ObjectExists($id)) {
                $name = IPS_GetName($id);
                $rowColor = '#C0FFC0'; //light green
            }
            switch ($messageID) {
                case [10001]:
                    $messageDescription = 'IPS_KERNELSTARTED';
                    break;

                case [10603]:
                    $messageDescription = 'VM_UPDATE';
                    break;

                default:
                    $messageDescription = 'keine Bezeichnung';
            }
            $registeredMessages[] = [
                'ObjectID'           => $id,
                'Name'               => $name,
                'MessageID'          => $messageID,
                'MessageDescription' => $messageDescription,
                'rowColor'           => $rowColor];
        }

        $form['actions'][] = [
            'type'    => 'ExpansionPanel',
            'caption' => 'Registrierte Nachrichten',
            'items'   => [
                [
                    'type'     => 'List',
                    'name'     => 'RegisteredMessages',
                    'rowCount' => 10,
                    'sort'     => [
                        'column'    => 'ObjectID',
                        'direction' => 'ascending'
                    ],
                    'columns' => [
                        [
                            'caption' => 'ID',
                            'name'    => 'ObjectID',
                            'width'   => '150px',
                            'onClick' => self::MODULE_PREFIX . '_ModifyButton($id, "RegisteredMessagesConfigurationButton", "ID " . $RegisteredMessages["ObjectID"] . " aufrufen", $RegisteredMessages["ObjectID"]);'
                        ],
                        [
                            'caption' => 'Name',
                            'name'    => 'Name',
                            'width'   => '300px',
                            'onClick' => self::MODULE_PREFIX . '_ModifyButton($id, "RegisteredMessagesConfigurationButton", "ID " . $RegisteredMessages["ObjectID"] . " aufrufen", $RegisteredMessages["ObjectID"]);'
                        ],
                        [
                            'caption' => 'Nachrichten ID',
                            'name'    => 'MessageID',
                            'width'   => '150px'
                        ],
                        [
                            'caption' => 'Nachrichten Bezeichnung',
                            'name'    => 'MessageDescription',
                            'width'   => '250px'
                        ]
                    ],
                    'values' => $registeredMessages
                ],
                [
                    'type'     => 'OpenObjectButton',
                    'name'     => 'RegisteredMessagesConfigurationButton',
                    'caption'  => 'Aufrufen',
                    'visible'  => false,
                    'objectID' => 0
                ]
            ]
        ];

        ########## Status

        $form['status'][] = [
            'code'    => 101,
            'icon'    => 'active',
            'caption' => self::MODULE_NAME . ' wird erstellt',
        ];
        $form['status'][] = [
            'code'    => 102,
            'icon'    => 'active',
            'caption' => self::MODULE_NAME . ' ist aktiv',
        ];
        $form['status'][] = [
            'code'    => 103,
            'icon'    => 'active',
            'caption' => self::MODULE_NAME . ' wird gelöscht',
        ];
        $form['status'][] = [
            'code'    => 104,
            'icon'    => 'inactive',
            'caption' => self::MODULE_NAME . ' ist inaktiv',
        ];
        $form['status'][] = [
            'code'    => 200,
            'icon'    => 'inactive',
            'caption' => 'Es ist Fehler aufgetreten, weitere Informationen unter Meldungen, im Log oder Debug!',
        ];

        return json_encode($form);
    }

    /**
     * Modifies a configuration button.
     *
     * @param string $Field
     * @param string $Caption
     * @param int $ObjectID
     * @return void
     */
    public function ModifyButton(string $Field, string $Caption, int $ObjectID): void
    {
        $state = false;
        if ($ObjectID > 1 && @IPS_ObjectExists($ObjectID)) { //0 = main category, 1 = none
            $state = true;
        }
        $this->UpdateFormField($Field, 'caption', $Caption);
        $this->UpdateFormField($Field, 'visible', $state);
        $this->UpdateFormField($Field, 'objectID', $ObjectID);
    }

    /**
     * Reloads the configuration form.
     *
     * @return void
     */
    public function ReloadConfig(): void
    {
        $this->ReloadForm();
    }
}