<?php

/**
 * @project       Alarmanlage/Alarmanlagenkonfigurator/helper/
 * @file          AAK_Config.php
 * @author        Ulrich Bittner
 * @copyright     2023 Ulrich Bittner
 * @license       https://creativecommons.org/licenses/by-nc-sa/4.0/ CC BY-NC-SA 4.0
 */

/** @noinspection PhpUnused */

declare(strict_types=1);

trait AAK_ConfigurationForm
{
    /**
     * Reloads the configuration form.
     *
     * @return void
     */
    public function ReloadConfig(): void
    {
        $this->ReloadForm();
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
     * Expands or collapses the expansion panels.
     *
     * @param bool $State
     * false =  collapse,
     * true =   expand
     *
     * @return void
     */
    public function ExpandExpansionPanels(bool $State): void
    {
        for ($i = 1; $i <= 2; $i++) {
            $this->UpdateFormField('Panel' . $i, 'expanded', $State);
        }
    }

    public function ShowLibraries(int $Library): void
    {
        if ($Library == 0) {
            for ($i = 1; $i <= 17; $i++) {
                $this->UpdateFormField('Label' . $i, 'visible', false);
                $this->UpdateFormField('Row' . $i, 'visible', false);
            }
        }

        if ($Library > 0 && $Library < 100) {
            for ($i = 1; $i <= 17; $i++) {
                if ($i == $Library) {
                    $visible = true;
                } else {
                    $visible = false;
                }
                $this->UpdateFormField('Label' . $i, 'visible', $visible);
                $this->UpdateFormField('Row' . $i, 'visible', $visible);
            }
        }

        if ($Library == 100) {
            for ($i = 1; $i <= 17; $i++) {
                $this->UpdateFormField('Label' . $i, 'visible', true);
                $this->UpdateFormField('Row' . $i, 'visible', true);
            }
        }
    }

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

        //Configuration buttons
        $form['elements'][0] =
            [
                'type'  => 'RowLayout',
                'items' => [
                    [
                        'type'    => 'Button',
                        'caption' => 'Konfiguration ausklappen',
                        'onClick' => self::MODULE_PREFIX . '_ExpandExpansionPanels($id, true);'
                    ],
                    [
                        'type'    => 'Button',
                        'caption' => 'Konfiguration einklappen',
                        'onClick' => self::MODULE_PREFIX . '_ExpandExpansionPanels($id, false);'
                    ],
                    [
                        'type'    => 'Button',
                        'caption' => 'Konfiguration neu laden',
                        'onClick' => self::MODULE_PREFIX . '_ReloadConfig($id);'
                    ]
                ]
            ];

        //Info
        $library = IPS_GetLibrary(self::LIBRARY_GUID);
        $module = IPS_GetModule(self::MODULE_GUID);
        $form['elements'][] = [
            'type'    => 'ExpansionPanel',
            'name'    => 'Panel1',
            'caption' => 'Info',
            'items'   => [
                [
                    'type'    => 'Label',
                    'name'    => 'ModuleID',
                    'caption' => "ID:\t\t\t" . $this->InstanceID
                ],
                [
                    'type'    => 'Label',
                    'caption' => "Modul:\t\t" . $module['ModuleName']
                ],
                [
                    'type'    => 'Label',
                    'caption' => "Präfix:\t\t" . $module['Prefix']
                ],
                [
                    'type'    => 'Label',
                    'caption' => "Version:\t\t" . $library['Version'] . '-' . $library['Build'] . ', ' . date('d.m.Y', $library['Date'])
                ],
                [
                    'type'    => 'Label',
                    'caption' => "Entwickler:\t" . $library['Author']
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

        ##### Repositories

        $form['elements'][] = [
            'type'    => 'ExpansionPanel',
            'name'    => 'Panel2',
            'caption' => 'Repositories',
            'items'   => [
                [
                    'type'  => 'RowLayout',
                    'items' => [
                        [
                            'type'    => 'ValidationTextBox',
                            'name'    => 'CommandControlURL',
                            'caption' => 'Ablaufsteuerung URL',
                            'width'   => '600px'
                        ]
                    ]
                ],
                [
                    'type'  => 'RowLayout',
                    'items' => [
                        [
                            'type'    => 'ValidationTextBox',
                            'name'    => 'UpdateDetectorURL',
                            'caption' => 'Aktualisierungsmelder URL',
                            'width'   => '600px'
                        ]
                    ]
                ],
                [
                    'type'  => 'RowLayout',
                    'items' => [
                        [
                            'type'    => 'ValidationTextBox',
                            'name'    => 'AlarmCallURL',
                            'caption' => 'Alarmanruf URL',
                            'width'   => '600px'
                        ]
                    ]
                ],
                [
                    'type'  => 'RowLayout',
                    'items' => [
                        [
                            'type'    => 'ValidationTextBox',
                            'name'    => 'AlarmLightURL',
                            'caption' => 'Alarmbeleuchtung URL',
                            'width'   => '600px'
                        ]
                    ]
                ],
                [
                    'type'  => 'RowLayout',
                    'items' => [
                        [
                            'type'    => 'ValidationTextBox',
                            'name'    => 'AlertingURL',
                            'caption' => 'Alarmierung URL',
                            'width'   => '600px'
                        ]
                    ]
                ],
                [
                    'type'  => 'RowLayout',
                    'items' => [
                        [
                            'type'    => 'ValidationTextBox',
                            'name'    => 'AlarmProtocolURL',
                            'caption' => 'Alarmprotokoll URL',
                            'width'   => '600px'
                        ]
                    ]
                ],
                [
                    'type'  => 'RowLayout',
                    'items' => [
                        [
                            'type'    => 'ValidationTextBox',
                            'name'    => 'AlarmSirenURL',
                            'caption' => 'Alarmsirene URL',
                            'width'   => '600px'
                        ]
                    ]
                ],
                [
                    'type'  => 'RowLayout',
                    'items' => [
                        [
                            'type'    => 'ValidationTextBox',
                            'name'    => 'AlarmZoneURL',
                            'caption' => 'Alarmzone URL',
                            'width'   => '600px'
                        ]
                    ]
                ],
                [
                    'type'  => 'RowLayout',
                    'items' => [
                        [
                            'type'    => 'ValidationTextBox',
                            'name'    => 'BatteryDetectorURL',
                            'caption' => 'Batteriemelder URL',
                            'width'   => '600px'
                        ]
                    ]
                ],
                [
                    'type'  => 'RowLayout',
                    'items' => [
                        [
                            'type'    => 'ValidationTextBox',
                            'name'    => 'NotificationURL',
                            'caption' => 'Benachrichtigung URL',
                            'width'   => '600px'
                        ]
                    ]
                ],
                [
                    'type'  => 'RowLayout',
                    'items' => [
                        [
                            'type'    => 'ValidationTextBox',
                            'name'    => 'RemoteControlURL',
                            'caption' => 'Fernbedienung URL',
                            'width'   => '600px'
                        ]
                    ]
                ],
                [
                    'type'  => 'RowLayout',
                    'items' => [
                        [
                            'type'    => 'ValidationTextBox',
                            'name'    => 'MailerURL',
                            'caption' => 'Mailer URL',
                            'width'   => '600px'
                        ]
                    ]
                ],
                [
                    'type'  => 'RowLayout',
                    'items' => [
                        [
                            'type'    => 'ValidationTextBox',
                            'name'    => 'StatusDisplayURL',
                            'caption' => 'Statusanzeige URL',
                            'width'   => '600px'
                        ]
                    ]
                ],
                [
                    'type'  => 'RowLayout',
                    'items' => [
                        [
                            'type'    => 'ValidationTextBox',
                            'name'    => 'StatusListURL',
                            'caption' => 'Statusliste URL',
                            'width'   => '600px'
                        ]
                    ]
                ],
                [
                    'type'  => 'RowLayout',
                    'items' => [
                        [
                            'type'    => 'ValidationTextBox',
                            'name'    => 'MaintenanceModeURL',
                            'caption' => 'Wartungsmodus URL',
                            'width'   => '600px'
                        ]
                    ]
                ],
                [
                    'type'  => 'RowLayout',
                    'items' => [
                        [
                            'type'    => 'ValidationTextBox',
                            'name'    => 'WarningIndicatorURL',
                            'caption' => 'Warnmelder URL',
                            'width'   => '600px'
                        ]
                    ]
                ],
                [
                    'type'  => 'RowLayout',
                    'items' => [
                        [
                            'type'    => 'ValidationTextBox',
                            'name'    => 'CentralStatusURL',
                            'caption' => 'Zentralenstatus URL',
                            'width'   => '600px'
                        ]
                    ]
                ]
            ]
        ];

        ########## Actions

        $form['actions'][] =
            [
                'type'    => 'SelectCategory',
                'name'    => 'CategoryID',
                'caption' => 'Installationsordner',
                'width'   => '600px',
                'value'   => 0
            ];

        $form['actions'][] =
            [
                'type'    => 'Select',
                'name'    => 'SelectLibrary',
                'caption' => 'Bibliothek',
                'options' => [
                    [
                        'caption' => 'Bitte auswählen',
                        'value'   => 0
                    ],
                    [
                        'caption' => 'Alle anzeigen',
                        'value'   => 100
                    ],
                    [
                        'caption' => 'Ablaufsteuerung',
                        'value'   => 1
                    ],
                    [
                        'caption' => 'Aktualisierungsmelder',
                        'value'   => 2
                    ],
                    [
                        'caption' => 'Alarmanruf',
                        'value'   => 3
                    ],
                    [
                        'caption' => 'Alarmbeleuchtung',
                        'value'   => 4
                    ],
                    [
                        'caption' => 'Alarmierung',
                        'value'   => 5
                    ],
                    [
                        'caption' => 'Alarmprotokoll',
                        'value'   => 6
                    ],
                    [
                        'caption' => 'Alarmsirene',
                        'value'   => 7
                    ],
                    [
                        'caption' => 'Alarmzone',
                        'value'   => 8
                    ],
                    [
                        'caption' => 'Batteriemelder',
                        'value'   => 9
                    ],
                    [
                        'caption' => 'Benachrichtigung',
                        'value'   => 10
                    ],
                    [
                        'caption' => 'Fernbedienung',
                        'value'   => 11
                    ],
                    [
                        'caption' => 'Mailer',
                        'value'   => 12
                    ],
                    [
                        'caption' => 'Statusanzeige',
                        'value'   => 13
                    ],
                    [
                        'caption' => 'Statusliste',
                        'value'   => 14
                    ],
                    [
                        'caption' => 'Wartungsmodus',
                        'value'   => 15
                    ],
                    [
                        'caption' => 'Warnmelder',
                        'value'   => 16
                    ],
                    [
                        'caption' => 'Zentralenstatus',
                        'value'   => 17
                    ]
                ],
                'onChange' => self::MODULE_PREFIX . '_ShowLibraries($id, $SelectLibrary);',
                'value'    => 0
            ];

        $form['actions'][] =
            [
                'type'    => 'Label',
                'caption' => ' '
            ];

        //Command control
        $form['actions'][] =
            [
                'type'    => 'Label',
                'name'    => 'Label1',
                'caption' => 'Ablaufsteuerung',
                'visible' => false
            ];

        $actionName = 'CommandControl';
        $libraryGUID = self::COMMAND_CONTROL_LIBRARY_GUID;
        $moduleGUID = self::COMMAND_CONTROL_MODULE_GUID;

        $enabled = true;
        $visible = false;
        if (@IPS_LibraryExists($libraryGUID)) {
            $enabled = false;
            $visible = true;
        }

        $form['actions'][] =
            [
                'type'    => 'RowLayout',
                'name'    => 'Row1',
                'visible' => false,
                'items'   => [
                    //Add library
                    [
                        'type'    => 'Button',
                        'name'    => 'Add' . $actionName . 'LibraryButton',
                        'caption' => 'Bibliothek hinzufügen',
                        'onClick' => self::MODULE_PREFIX . '_AddLibrary($id, "' . $actionName . '");',
                        'enabled' => $enabled
                    ],
                    //Select module
                    [
                        'type'    => 'Select',
                        'name'    => 'Select' . $actionName . 'Module',
                        'caption' => 'Modul',
                        'width'   => '400px',
                        'visible' => $visible,
                        'options' => [
                            [
                                'caption' => 'Ablaufsteuerung',
                                'value'   => $moduleGUID
                            ]
                        ],
                        'onChange' => self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "moduleID", $Select' . $actionName . 'Module);' . self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "value", 0);' . self::MODULE_PREFIX . '_UpdateField($id, "Configure' . $actionName . 'InstanceButton", "visible", false);',
                        'value'    => $moduleGUID
                    ],
                    //Create instance
                    [
                        'type'    => 'Button',
                        'name'    => 'Create' . $actionName . 'InstanceButton',
                        'caption' => 'Neue Instanz erstellen',
                        'onClick' => self::MODULE_PREFIX . '_CreateInstance($id, $Select' . $actionName . 'Module, $CategoryID);',
                        'visible' => $visible
                    ],
                    //Select instance
                    [
                        'type'     => 'SelectModule',
                        'name'     => 'Select' . $actionName . 'Instance',
                        'caption'  => 'Instanz',
                        'width'    => '600px',
                        'moduleID' => $moduleGUID,
                        'visible'  => $visible,
                        'onChange' => self::MODULE_PREFIX . '_ModifyButton($id, "Configure' . $actionName . 'InstanceButton", "ID " . $Select' . $actionName . 'Instance . " konfigurieren", $Select' . $actionName . 'Instance);'
                    ],
                    //Configure instance
                    [
                        'type'     => 'OpenObjectButton',
                        'caption'  => 'Konfigurieren',
                        'name'     => 'Configure' . $actionName . 'InstanceButton',
                        'visible'  => false,
                        'objectID' => 0
                    ]
                ]
            ];

        //Update detector
        $form['actions'][] =
            [
                'type'    => 'Label',
                'name'    => 'Label2',
                'caption' => 'Aktualisierungsmelder',
                'visible' => false
            ];

        $actionName = 'UpdateDetector';
        $libraryGUID = self::UPDATE_DETECTOR_LIBRARY_GUID;
        $moduleGUID = self::UPDATE_DETECTOR_MODULE_GUID;

        $enabled = true;
        $visible = false;
        if (@IPS_LibraryExists($libraryGUID)) {
            $enabled = false;
            $visible = true;
        }

        $form['actions'][] =
            [
                'type'    => 'RowLayout',
                'name'    => 'Row2',
                'visible' => false,
                'items'   => [
                    //Add library
                    [
                        'type'    => 'Button',
                        'name'    => 'Add' . $actionName . 'LibraryButton',
                        'caption' => 'Bibliothek hinzufügen',
                        'onClick' => self::MODULE_PREFIX . '_AddLibrary($id, "' . $actionName . '");',
                        'enabled' => $enabled
                    ],
                    //Select module
                    [
                        'type'    => 'Select',
                        'name'    => 'Select' . $actionName . 'Module',
                        'caption' => 'Modul',
                        'width'   => '400px',
                        'visible' => $visible,
                        'options' => [
                            [
                                'caption' => 'Aktualisierungsmelder',
                                'value'   => $moduleGUID
                            ]
                        ],
                        'onChange' => self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "moduleID", $Select' . $actionName . 'Module);' . self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "value", 0);' . self::MODULE_PREFIX . '_UpdateField($id, "Configure' . $actionName . 'InstanceButton", "visible", false);',
                        'value'    => $moduleGUID
                    ],
                    //Create instance
                    [
                        'type'    => 'Button',
                        'name'    => 'Create' . $actionName . 'InstanceButton',
                        'caption' => 'Neue Instanz erstellen',
                        'onClick' => self::MODULE_PREFIX . '_CreateInstance($id, $Select' . $actionName . 'Module, $CategoryID);',
                        'visible' => $visible
                    ],
                    //Select instance
                    [
                        'type'     => 'SelectModule',
                        'name'     => 'Select' . $actionName . 'Instance',
                        'caption'  => 'Instanz',
                        'width'    => '600px',
                        'moduleID' => $moduleGUID,
                        'visible'  => $visible,
                        'onChange' => self::MODULE_PREFIX . '_ModifyButton($id, "Configure' . $actionName . 'InstanceButton", "ID " . $Select' . $actionName . 'Instance . " konfigurieren", $Select' . $actionName . 'Instance);'
                    ],
                    //Configure instance
                    [
                        'type'     => 'OpenObjectButton',
                        'caption'  => 'Konfigurieren',
                        'name'     => 'Configure' . $actionName . 'InstanceButton',
                        'visible'  => false,
                        'objectID' => 0
                    ]
                ]
            ];

        //Alarm call
        $form['actions'][] =
            [
                'type'    => 'Label',
                'name'    => 'Label3',
                'caption' => 'Alarmanruf',
                'visible' => false
            ];

        $actionName = 'AlarmCall';
        $libraryGUID = self::ALARM_CALL_LIBRARY_GUID;
        $moduleGUID = self::ALARM_CALL_MODULE_GUID;

        $enabled = true;
        $visible = false;
        if (@IPS_LibraryExists($libraryGUID)) {
            $enabled = false;
            $visible = true;
        }

        $form['actions'][] =
            [
                'type'    => 'RowLayout',
                'name'    => 'Row3',
                'visible' => false,
                'items'   => [
                    //Add library
                    [
                        'type'    => 'Button',
                        'name'    => 'Add' . $actionName . 'LibraryButton',
                        'caption' => 'Bibliothek hinzufügen',
                        'onClick' => self::MODULE_PREFIX . '_AddLibrary($id, "' . $actionName . '");',
                        'enabled' => $enabled
                    ],
                    //Select module
                    [
                        'type'    => 'Select',
                        'name'    => 'Select' . $actionName . 'Module',
                        'caption' => 'Modul',
                        'width'   => '400px',
                        'visible' => $visible,
                        'options' => [
                            [
                                'caption' => 'Alarmanruf',
                                'value'   => $moduleGUID
                            ],
                            [
                                'caption' => 'Alarmanruf NeXXt Mobile',
                                'value'   => self::ALARM_CALL_NEXXT_MOBILE_MODULE_GUID
                            ],
                            [
                                'caption' => 'Alarmanruf VoIP',
                                'value'   => self::ALARM_CALL_VOIP_MODULE_GUID
                            ]
                        ],
                        'onChange' => self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "moduleID", $Select' . $actionName . 'Module);' . self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "value", 0);' . self::MODULE_PREFIX . '_UpdateField($id, "Configure' . $actionName . 'InstanceButton", "visible", false);',
                        'value'    => $moduleGUID
                    ],
                    //Create instance
                    [
                        'type'    => 'Button',
                        'name'    => 'Create' . $actionName . 'InstanceButton',
                        'caption' => 'Neue Instanz erstellen',
                        'onClick' => self::MODULE_PREFIX . '_CreateInstance($id, $Select' . $actionName . 'Module, $CategoryID);',
                        'visible' => $visible
                    ],
                    //Select instance
                    [
                        'type'     => 'SelectModule',
                        'name'     => 'Select' . $actionName . 'Instance',
                        'caption'  => 'Instanz',
                        'width'    => '600px',
                        'moduleID' => $moduleGUID,
                        'visible'  => $visible,
                        'onChange' => self::MODULE_PREFIX . '_ModifyButton($id, "Configure' . $actionName . 'InstanceButton", "ID " . $Select' . $actionName . 'Instance . " konfigurieren", $Select' . $actionName . 'Instance);'
                    ],
                    //Configure instance
                    [
                        'type'     => 'OpenObjectButton',
                        'caption'  => 'Konfigurieren',
                        'name'     => 'Configure' . $actionName . 'InstanceButton',
                        'visible'  => false,
                        'objectID' => 0
                    ]
                ]
            ];

        //Alarm light
        $form['actions'][] =
            [
                'type'    => 'Label',
                'name'    => 'Label4',
                'caption' => 'Alarmbeleuchtung',
                'visible' => false
            ];

        $actionName = 'AlarmLight';
        $libraryGUID = self::ALARM_LIGHT_LIBRARY_GUID;
        $moduleGUID = self::ALARM_LIGHT_MODULE_GUID;

        $enabled = true;
        $visible = false;
        if (@IPS_LibraryExists($libraryGUID)) {
            $enabled = false;
            $visible = true;
        }

        $form['actions'][] =
            [
                'type'    => 'RowLayout',
                'name'    => 'Row4',
                'visible' => false,
                'items'   => [
                    //Add library
                    [
                        'type'    => 'Button',
                        'name'    => 'Add' . $actionName . 'LibraryButton',
                        'caption' => 'Bibliothek hinzufügen',
                        'onClick' => self::MODULE_PREFIX . '_AddLibrary($id, "' . $actionName . '");',
                        'enabled' => $enabled
                    ],
                    //Select module
                    [
                        'type'    => 'Select',
                        'name'    => 'Select' . $actionName . 'Module',
                        'caption' => 'Modul',
                        'width'   => '400px',
                        'visible' => $visible,
                        'options' => [
                            [
                                'caption' => 'Alarmbeleuchtung',
                                'value'   => $moduleGUID
                            ]
                        ],
                        'onChange' => self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "moduleID", $Select' . $actionName . 'Module);' . self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "value", 0);' . self::MODULE_PREFIX . '_UpdateField($id, "Configure' . $actionName . 'InstanceButton", "visible", false);',
                        'value'    => $moduleGUID
                    ],
                    //Create instance
                    [
                        'type'    => 'Button',
                        'name'    => 'Create' . $actionName . 'InstanceButton',
                        'caption' => 'Neue Instanz erstellen',
                        'onClick' => self::MODULE_PREFIX . '_CreateInstance($id, $Select' . $actionName . 'Module, $CategoryID);',
                        'visible' => $visible
                    ],
                    //Select instance
                    [
                        'type'     => 'SelectModule',
                        'name'     => 'Select' . $actionName . 'Instance',
                        'caption'  => 'Instanz',
                        'width'    => '600px',
                        'moduleID' => $moduleGUID,
                        'visible'  => $visible,
                        'onChange' => self::MODULE_PREFIX . '_ModifyButton($id, "Configure' . $actionName . 'InstanceButton", "ID " . $Select' . $actionName . 'Instance . " konfigurieren", $Select' . $actionName . 'Instance);'
                    ],
                    //Configure instance
                    [
                        'type'     => 'OpenObjectButton',
                        'caption'  => 'Konfigurieren',
                        'name'     => 'Configure' . $actionName . 'InstanceButton',
                        'visible'  => false,
                        'objectID' => 0
                    ]
                ]
            ];

        //Alerting
        $form['actions'][] =
            [
                'type'    => 'Label',
                'name'    => 'Label5',
                'caption' => 'Alarmierung',
                'visible' => false
            ];

        $actionName = 'Alerting';
        $libraryGUID = self::ALERTING_LIBRARY_GUID;
        $moduleGUID = self::ALERTING_MODULE_GUID;

        $enabled = true;
        $visible = false;
        if (@IPS_LibraryExists($libraryGUID)) {
            $enabled = false;
            $visible = true;
        }

        $form['actions'][] =
            [
                'type'    => 'RowLayout',
                'name'    => 'Row5',
                'visible' => false,
                'items'   => [
                    //Add library
                    [
                        'type'    => 'Button',
                        'name'    => 'Add' . $actionName . 'LibraryButton',
                        'caption' => 'Bibliothek hinzufügen',
                        'onClick' => self::MODULE_PREFIX . '_AddLibrary($id, "' . $actionName . '");',
                        'enabled' => $enabled
                    ],
                    //Select module
                    [
                        'type'    => 'Select',
                        'name'    => 'Select' . $actionName . 'Module',
                        'caption' => 'Modul',
                        'width'   => '400px',
                        'visible' => $visible,
                        'options' => [
                            [
                                'caption' => 'Alarmierung',
                                'value'   => $moduleGUID
                            ]
                        ],
                        'onChange' => self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "moduleID", $Select' . $actionName . 'Module);' . self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "value", 0);' . self::MODULE_PREFIX . '_UpdateField($id, "Configure' . $actionName . 'InstanceButton", "visible", false);',
                        'value'    => $moduleGUID
                    ],
                    //Create instance
                    [
                        'type'    => 'Button',
                        'name'    => 'Create' . $actionName . 'InstanceButton',
                        'caption' => 'Neue Instanz erstellen',
                        'onClick' => self::MODULE_PREFIX . '_CreateInstance($id, $Select' . $actionName . 'Module, $CategoryID);',
                        'visible' => $visible
                    ],
                    //Select instance
                    [
                        'type'     => 'SelectModule',
                        'name'     => 'Select' . $actionName . 'Instance',
                        'caption'  => 'Instanz',
                        'width'    => '600px',
                        'moduleID' => $moduleGUID,
                        'visible'  => $visible,
                        'onChange' => self::MODULE_PREFIX . '_ModifyButton($id, "Configure' . $actionName . 'InstanceButton", "ID " . $Select' . $actionName . 'Instance . " konfigurieren", $Select' . $actionName . 'Instance);'
                    ],
                    //Configure instance
                    [
                        'type'     => 'OpenObjectButton',
                        'caption'  => 'Konfigurieren',
                        'name'     => 'Configure' . $actionName . 'InstanceButton',
                        'visible'  => false,
                        'objectID' => 0
                    ]
                ]
            ];

        //Alarm protocol
        $form['actions'][] =
            [
                'type'    => 'Label',
                'name'    => 'Label6',
                'caption' => 'Alarmprotokoll',
                'visible' => false
            ];

        $actionName = 'AlarmProtocol';
        $libraryGUID = self::ALARM_PROTOCOL_LIBRARY_GUID;
        $moduleGUID = self::ALARM_PROTOCOL_MODULE_GUID;

        $enabled = true;
        $visible = false;
        if (@IPS_LibraryExists($libraryGUID)) {
            $enabled = false;
            $visible = true;
        }

        $form['actions'][] =
            [
                'type'    => 'RowLayout',
                'name'    => 'Row6',
                'visible' => false,
                'items'   => [
                    //Add library
                    [
                        'type'    => 'Button',
                        'name'    => 'Add' . $actionName . 'LibraryButton',
                        'caption' => 'Bibliothek hinzufügen',
                        'onClick' => self::MODULE_PREFIX . '_AddLibrary($id, "' . $actionName . '");',
                        'enabled' => $enabled
                    ],
                    //Select module
                    [
                        'type'    => 'Select',
                        'name'    => 'Select' . $actionName . 'Module',
                        'caption' => 'Modul',
                        'width'   => '400px',
                        'visible' => $visible,
                        'options' => [
                            [
                                'caption' => 'Alarmprotokoll',
                                'value'   => $moduleGUID
                            ]
                        ],
                        'onChange' => self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "moduleID", $Select' . $actionName . 'Module);' . self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "value", 0);' . self::MODULE_PREFIX . '_UpdateField($id, "Configure' . $actionName . 'InstanceButton", "visible", false);',
                        'value'    => $moduleGUID
                    ],
                    //Create instance
                    [
                        'type'    => 'Button',
                        'name'    => 'Create' . $actionName . 'InstanceButton',
                        'caption' => 'Neue Instanz erstellen',
                        'onClick' => self::MODULE_PREFIX . '_CreateInstance($id, $Select' . $actionName . 'Module, $CategoryID);',
                        'visible' => $visible
                    ],
                    //Select instance
                    [
                        'type'     => 'SelectModule',
                        'name'     => 'Select' . $actionName . 'Instance',
                        'caption'  => 'Instanz',
                        'width'    => '600px',
                        'moduleID' => $moduleGUID,
                        'visible'  => $visible,
                        'onChange' => self::MODULE_PREFIX . '_ModifyButton($id, "Configure' . $actionName . 'InstanceButton", "ID " . $Select' . $actionName . 'Instance . " konfigurieren", $Select' . $actionName . 'Instance);'
                    ],
                    //Configure instance
                    [
                        'type'     => 'OpenObjectButton',
                        'caption'  => 'Konfigurieren',
                        'name'     => 'Configure' . $actionName . 'InstanceButton',
                        'visible'  => false,
                        'objectID' => 0
                    ]
                ]
            ];

        //Alarm siren
        $form['actions'][] =
            [
                'type'    => 'Label',
                'name'    => 'Label7',
                'caption' => 'Alarmsirene',
                'visible' => false
            ];

        $actionName = 'AlarmSiren';
        $libraryGUID = self::ALARM_SIREN_LIBRARY_GUID;
        $moduleGUID = self::ALARM_SIREN_MODULE_GUID;

        $enabled = true;
        $visible = false;
        if (@IPS_LibraryExists($libraryGUID)) {
            $enabled = false;
            $visible = true;
        }

        $form['actions'][] =
            [
                'type'    => 'RowLayout',
                'name'    => 'Row7',
                'visible' => false,
                'items'   => [
                    //Add library
                    [
                        'type'    => 'Button',
                        'name'    => 'Add' . $actionName . 'LibraryButton',
                        'caption' => 'Bibliothek hinzufügen',
                        'onClick' => self::MODULE_PREFIX . '_AddLibrary($id, "' . $actionName . '");',
                        'enabled' => $enabled
                    ],
                    //Select module
                    [
                        'type'    => 'Select',
                        'name'    => 'Select' . $actionName . 'Module',
                        'caption' => 'Modul',
                        'width'   => '400px',
                        'visible' => $visible,
                        'options' => [
                            [
                                'caption' => 'Alarmsirene',
                                'value'   => $moduleGUID
                            ],
                            [
                                'caption' => 'Alarmsirene Homematic',
                                'value'   => self::ALARM_SIREN_HOMEMATIC_MODULE_GUID
                            ],
                            [
                                'caption' => 'Alarmsirene Homematic IP',
                                'value'   => self::ALARM_SIREN_HOMEMATICIP_MODULE_GUID
                            ]
                        ],
                        'onChange' => self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "moduleID", $Select' . $actionName . 'Module);' . self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "value", 0);' . self::MODULE_PREFIX . '_UpdateField($id, "Configure' . $actionName . 'InstanceButton", "visible", false);',
                        'value'    => $moduleGUID
                    ],
                    //Create instance
                    [
                        'type'    => 'Button',
                        'name'    => 'Create' . $actionName . 'InstanceButton',
                        'caption' => 'Neue Instanz erstellen',
                        'onClick' => self::MODULE_PREFIX . '_CreateInstance($id, $Select' . $actionName . 'Module, $CategoryID);',
                        'visible' => $visible
                    ],
                    //Select instance
                    [
                        'type'     => 'SelectModule',
                        'name'     => 'Select' . $actionName . 'Instance',
                        'caption'  => 'Instanz',
                        'width'    => '600px',
                        'moduleID' => $moduleGUID,
                        'visible'  => $visible,
                        'onChange' => self::MODULE_PREFIX . '_ModifyButton($id, "Configure' . $actionName . 'InstanceButton", "ID " . $Select' . $actionName . 'Instance . " konfigurieren", $Select' . $actionName . 'Instance);'
                    ],
                    //Configure instance
                    [
                        'type'     => 'OpenObjectButton',
                        'caption'  => 'Konfigurieren',
                        'name'     => 'Configure' . $actionName . 'InstanceButton',
                        'visible'  => false,
                        'objectID' => 0
                    ]
                ]
            ];

        //Alarm zone
        $form['actions'][] =
            [
                'type'    => 'Label',
                'name'    => 'Label8',
                'caption' => 'Alarmzone',
                'visible' => false
            ];

        $actionName = 'AlarmZone';
        $libraryGUID = self::ALARM_ZONE_LIBRARY_GUID;
        $moduleGUID = self::ALARM_ZONE_MODULE_GUID;

        $enabled = true;
        $visible = false;
        if (@IPS_LibraryExists($libraryGUID)) {
            $enabled = false;
            $visible = true;
        }

        $form['actions'][] =
            [
                'type'    => 'RowLayout',
                'name'    => 'Row8',
                'visible' => false,
                'items'   => [
                    //Add library
                    [
                        'type'    => 'Button',
                        'name'    => 'Add' . $actionName . 'LibraryButton',
                        'caption' => 'Bibliothek hinzufügen',
                        'onClick' => self::MODULE_PREFIX . '_AddLibrary($id, "' . $actionName . '");',
                        'enabled' => $enabled
                    ],
                    //Select module
                    [
                        'type'    => 'Select',
                        'name'    => 'Select' . $actionName . 'Module',
                        'caption' => 'Modul',
                        'width'   => '400px',
                        'visible' => $visible,
                        'options' => [
                            [
                                'caption' => 'Alarmzone',
                                'value'   => $moduleGUID
                            ],
                            [
                                'caption' => 'Alarmzonensteuerung',
                                'value'   => self::ALARM_ZONE_CONTROL_MODULE_GUID
                            ]
                        ],
                        'onChange' => self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "moduleID", $Select' . $actionName . 'Module);' . self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "value", 0);' . self::MODULE_PREFIX . '_UpdateField($id, "Configure' . $actionName . 'InstanceButton", "visible", false);',
                        'value'    => $moduleGUID
                    ],
                    //Create instance
                    [
                        'type'    => 'Button',
                        'name'    => 'Create' . $actionName . 'InstanceButton',
                        'caption' => 'Neue Instanz erstellen',
                        'onClick' => self::MODULE_PREFIX . '_CreateInstance($id, $Select' . $actionName . 'Module, $CategoryID);',
                        'visible' => $visible
                    ],
                    //Select instance
                    [
                        'type'     => 'SelectModule',
                        'name'     => 'Select' . $actionName . 'Instance',
                        'caption'  => 'Instanz',
                        'width'    => '600px',
                        'moduleID' => $moduleGUID,
                        'visible'  => $visible,
                        'onChange' => self::MODULE_PREFIX . '_ModifyButton($id, "Configure' . $actionName . 'InstanceButton", "ID " . $Select' . $actionName . 'Instance . " konfigurieren", $Select' . $actionName . 'Instance);'
                    ],
                    //Configure instance
                    [
                        'type'     => 'OpenObjectButton',
                        'caption'  => 'Konfigurieren',
                        'name'     => 'Configure' . $actionName . 'InstanceButton',
                        'visible'  => false,
                        'objectID' => 0
                    ]
                ]
            ];

        //Battery detector
        $form['actions'][] =
            [
                'type'    => 'Label',
                'name'    => 'Label9',
                'caption' => 'Batteriemelder',
                'visible' => false
            ];

        $actionName = 'BatteryDetector';
        $libraryGUID = self::BATTERY_DETECTOR_LIBRARY_GUID;
        $moduleGUID = self::BATTERY_DETECTOR_MODULE_GUID;

        $enabled = true;
        $visible = false;
        if (@IPS_LibraryExists($libraryGUID)) {
            $enabled = false;
            $visible = true;
        }

        $form['actions'][] =
            [
                'type'    => 'RowLayout',
                'name'    => 'Row9',
                'visible' => false,
                'items'   => [
                    //Add library
                    [
                        'type'    => 'Button',
                        'name'    => 'Add' . $actionName . 'LibraryButton',
                        'caption' => 'Bibliothek hinzufügen',
                        'onClick' => self::MODULE_PREFIX . '_AddLibrary($id, "' . $actionName . '");',
                        'enabled' => $enabled
                    ],
                    //Select module
                    [
                        'type'    => 'Select',
                        'name'    => 'Select' . $actionName . 'Module',
                        'caption' => 'Modul',
                        'width'   => '400px',
                        'visible' => $visible,
                        'options' => [
                            [
                                'caption' => 'Batteriemelder',
                                'value'   => $moduleGUID
                            ]
                        ],
                        'onChange' => self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "moduleID", $Select' . $actionName . 'Module);' . self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "value", 0);' . self::MODULE_PREFIX . '_UpdateField($id, "Configure' . $actionName . 'InstanceButton", "visible", false);',
                        'value'    => $moduleGUID
                    ],
                    //Create instance
                    [
                        'type'    => 'Button',
                        'name'    => 'Create' . $actionName . 'InstanceButton',
                        'caption' => 'Neue Instanz erstellen',
                        'onClick' => self::MODULE_PREFIX . '_CreateInstance($id, $Select' . $actionName . 'Module, $CategoryID);',
                        'visible' => $visible
                    ],
                    //Select instance
                    [
                        'type'     => 'SelectModule',
                        'name'     => 'Select' . $actionName . 'Instance',
                        'caption'  => 'Instanz',
                        'width'    => '600px',
                        'moduleID' => $moduleGUID,
                        'visible'  => $visible,
                        'onChange' => self::MODULE_PREFIX . '_ModifyButton($id, "Configure' . $actionName . 'InstanceButton", "ID " . $Select' . $actionName . 'Instance . " konfigurieren", $Select' . $actionName . 'Instance);'
                    ],
                    //Configure instance
                    [
                        'type'     => 'OpenObjectButton',
                        'caption'  => 'Konfigurieren',
                        'name'     => 'Configure' . $actionName . 'InstanceButton',
                        'visible'  => false,
                        'objectID' => 0
                    ]
                ]
            ];

        //Notification
        $form['actions'][] =
            [
                'type'    => 'Label',
                'name'    => 'Label10',
                'caption' => 'Benachrichtigung',
                'visible' => false
            ];

        $actionName = 'Notification';
        $libraryGUID = self::NOTIFICATION_LIBRARY_GUID;
        $moduleGUID = self::NOTIFICATION_MODULE_GUID;

        $enabled = true;
        $visible = false;
        if (@IPS_LibraryExists($libraryGUID)) {
            $enabled = false;
            $visible = true;
        }

        $form['actions'][] =
            [
                'type'    => 'RowLayout',
                'name'    => 'Row10',
                'visible' => false,
                'items'   => [
                    //Add library
                    [
                        'type'    => 'Button',
                        'name'    => 'Add' . $actionName . 'LibraryButton',
                        'caption' => 'Bibliothek hinzufügen',
                        'onClick' => self::MODULE_PREFIX . '_AddLibrary($id, "' . $actionName . '");',
                        'enabled' => $enabled
                    ],
                    //Select module
                    [
                        'type'    => 'Select',
                        'name'    => 'Select' . $actionName . 'Module',
                        'caption' => 'Modul',
                        'width'   => '400px',
                        'visible' => $visible,
                        'options' => [
                            [
                                'caption' => 'Benachrichtigung',
                                'value'   => $moduleGUID
                            ]
                        ],
                        'onChange' => self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "moduleID", $Select' . $actionName . 'Module);' . self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "value", 0);' . self::MODULE_PREFIX . '_UpdateField($id, "Configure' . $actionName . 'InstanceButton", "visible", false);',
                        'value'    => $moduleGUID
                    ],
                    //Create instance
                    [
                        'type'    => 'Button',
                        'name'    => 'Create' . $actionName . 'InstanceButton',
                        'caption' => 'Neue Instanz erstellen',
                        'onClick' => self::MODULE_PREFIX . '_CreateInstance($id, $Select' . $actionName . 'Module, $CategoryID);',
                        'visible' => $visible
                    ],
                    //Select instance
                    [
                        'type'     => 'SelectModule',
                        'name'     => 'Select' . $actionName . 'Instance',
                        'caption'  => 'Instanz',
                        'width'    => '600px',
                        'moduleID' => $moduleGUID,
                        'visible'  => $visible,
                        'onChange' => self::MODULE_PREFIX . '_ModifyButton($id, "Configure' . $actionName . 'InstanceButton", "ID " . $Select' . $actionName . 'Instance . " konfigurieren", $Select' . $actionName . 'Instance);'
                    ],
                    //Configure instance
                    [
                        'type'     => 'OpenObjectButton',
                        'caption'  => 'Konfigurieren',
                        'name'     => 'Configure' . $actionName . 'InstanceButton',
                        'visible'  => false,
                        'objectID' => 0
                    ]
                ]
            ];

        //Remote control
        $form['actions'][] =
            [
                'type'    => 'Label',
                'name'    => 'Label11',
                'caption' => 'Fernbedienung',
                'visible' => false
            ];

        $actionName = 'RemoteControl';
        $libraryGUID = self::REMOTE_CONTROL_LIBRARY_GUID;
        $moduleGUID = self::REMOTE_CONTROL_MODULE_GUID;

        $enabled = true;
        $visible = false;
        if (@IPS_LibraryExists($libraryGUID)) {
            $enabled = false;
            $visible = true;
        }

        $form['actions'][] =
            [
                'type'    => 'RowLayout',
                'name'    => 'Row13',
                'visible' => false,
                'items'   => [
                    //Add library
                    [
                        'type'    => 'Button',
                        'name'    => 'Add' . $actionName . 'LibraryButton',
                        'caption' => 'Bibliothek hinzufügen',
                        'onClick' => self::MODULE_PREFIX . '_AddLibrary($id, "' . $actionName . '");',
                        'enabled' => $enabled
                    ],
                    //Select module
                    [
                        'type'    => 'Select',
                        'name'    => 'Select' . $actionName . 'Module',
                        'caption' => 'Modul',
                        'width'   => '400px',
                        'visible' => $visible,
                        'options' => [
                            [
                                'caption' => 'Fernbedienung',
                                'value'   => $moduleGUID
                            ]
                        ],
                        'onChange' => self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "moduleID", $Select' . $actionName . 'Module);' . self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "value", 0);' . self::MODULE_PREFIX . '_UpdateField($id, "Configure' . $actionName . 'InstanceButton", "visible", false);',
                        'value'    => $moduleGUID
                    ],
                    //Create instance
                    [
                        'type'    => 'Button',
                        'name'    => 'Create' . $actionName . 'InstanceButton',
                        'caption' => 'Neue Instanz erstellen',
                        'onClick' => self::MODULE_PREFIX . '_CreateInstance($id, $Select' . $actionName . 'Module, $CategoryID);',
                        'visible' => $visible
                    ],
                    //Select instance
                    [
                        'type'     => 'SelectModule',
                        'name'     => 'Select' . $actionName . 'Instance',
                        'caption'  => 'Instanz',
                        'width'    => '600px',
                        'moduleID' => $moduleGUID,
                        'visible'  => $visible,
                        'onChange' => self::MODULE_PREFIX . '_ModifyButton($id, "Configure' . $actionName . 'InstanceButton", "ID " . $Select' . $actionName . 'Instance . " konfigurieren", $Select' . $actionName . 'Instance);'
                    ],
                    //Configure instance
                    [
                        'type'     => 'OpenObjectButton',
                        'caption'  => 'Konfigurieren',
                        'name'     => 'Configure' . $actionName . 'InstanceButton',
                        'visible'  => false,
                        'objectID' => 0
                    ]
                ]
            ];

        //Mailer
        $form['actions'][] =
            [
                'type'    => 'Label',
                'name'    => 'Label12',
                'caption' => 'Mailer',
                'visible' => false
            ];

        $actionName = 'Mailer';
        $libraryGUID = self::MAILER_LIBRARY_GUID;
        $moduleGUID = self::MAILER_MODULE_GUID;

        $enabled = true;
        $visible = false;
        if (@IPS_LibraryExists($libraryGUID)) {
            $enabled = false;
            $visible = true;
        }

        $form['actions'][] =
            [
                'type'    => 'RowLayout',
                'name'    => 'Row14',
                'visible' => false,
                'items'   => [
                    //Add library
                    [
                        'type'    => 'Button',
                        'name'    => 'Add' . $actionName . 'LibraryButton',
                        'caption' => 'Bibliothek hinzufügen',
                        'onClick' => self::MODULE_PREFIX . '_AddLibrary($id, "' . $actionName . '");',
                        'enabled' => $enabled
                    ],
                    //Select module
                    [
                        'type'    => 'Select',
                        'name'    => 'Select' . $actionName . 'Module',
                        'caption' => 'Modul',
                        'width'   => '400px',
                        'visible' => $visible,
                        'options' => [
                            [
                                'caption' => 'Mailer',
                                'value'   => $moduleGUID
                            ]
                        ],
                        'onChange' => self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "moduleID", $Select' . $actionName . 'Module);' . self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "value", 0);' . self::MODULE_PREFIX . '_UpdateField($id, "Configure' . $actionName . 'InstanceButton", "visible", false);',
                        'value'    => $moduleGUID
                    ],
                    //Create instance
                    [
                        'type'    => 'Button',
                        'name'    => 'Create' . $actionName . 'InstanceButton',
                        'caption' => 'Neue Instanz erstellen',
                        'onClick' => self::MODULE_PREFIX . '_CreateInstance($id, $Select' . $actionName . 'Module, $CategoryID);',
                        'visible' => $visible
                    ],
                    //Select instance
                    [
                        'type'     => 'SelectModule',
                        'name'     => 'Select' . $actionName . 'Instance',
                        'caption'  => 'Instanz',
                        'width'    => '600px',
                        'moduleID' => $moduleGUID,
                        'visible'  => $visible,
                        'onChange' => self::MODULE_PREFIX . '_ModifyButton($id, "Configure' . $actionName . 'InstanceButton", "ID " . $Select' . $actionName . 'Instance . " konfigurieren", $Select' . $actionName . 'Instance);'
                    ],
                    //Configure instance
                    [
                        'type'     => 'OpenObjectButton',
                        'caption'  => 'Konfigurieren',
                        'name'     => 'Configure' . $actionName . 'InstanceButton',
                        'visible'  => false,
                        'objectID' => 0
                    ]
                ]
            ];

        //Status display
        $form['actions'][] =
            [
                'type'    => 'Label',
                'name'    => 'Label13',
                'caption' => 'Statusanzeige',
                'visible' => false
            ];

        $actionName = 'StatusDisplay';
        $libraryGUID = self::STATUS_DISPLAY_LIBRARY_GUID;
        $moduleGUID = self::STATUS_DISPLAY_MODULE_GUID;

        $enabled = true;
        $visible = false;
        if (@IPS_LibraryExists($libraryGUID)) {
            $enabled = false;
            $visible = true;
        }

        $form['actions'][] =
            [
                'type'    => 'RowLayout',
                'name'    => 'Row15',
                'visible' => false,
                'items'   => [
                    //Add library
                    [
                        'type'    => 'Button',
                        'name'    => 'Add' . $actionName . 'LibraryButton',
                        'caption' => 'Bibliothek hinzufügen',
                        'onClick' => self::MODULE_PREFIX . '_AddLibrary($id, "' . $actionName . '");',
                        'enabled' => $enabled
                    ],
                    //Select module
                    [
                        'type'    => 'Select',
                        'name'    => 'Select' . $actionName . 'Module',
                        'caption' => 'Modul',
                        'width'   => '400px',
                        'visible' => $visible,
                        'options' => [
                            [
                                'caption' => 'Statusanzeige',
                                'value'   => $moduleGUID
                            ],
                            [
                                'caption' => 'Statusanzeige Homematic',
                                'value'   => self::STATUS_DISPLAY_HOMEMATIC_MODULE_GUID
                            ],
                            [
                                'caption' => 'Statusanzeige Homematic IP',
                                'value'   => self::STATUS_DISPLAY_HOMEMATICIP_MODULE_GUID
                            ]
                        ],
                        'onChange' => self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "moduleID", $Select' . $actionName . 'Module);' . self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "value", 0);' . self::MODULE_PREFIX . '_UpdateField($id, "Configure' . $actionName . 'InstanceButton", "visible", false);',
                        'value'    => $moduleGUID
                    ],
                    //Create instance
                    [
                        'type'    => 'Button',
                        'name'    => 'Create' . $actionName . 'InstanceButton',
                        'caption' => 'Neue Instanz erstellen',
                        'onClick' => self::MODULE_PREFIX . '_CreateInstance($id, $Select' . $actionName . 'Module, $CategoryID);',
                        'visible' => $visible
                    ],
                    //Select instance
                    [
                        'type'     => 'SelectModule',
                        'name'     => 'Select' . $actionName . 'Instance',
                        'caption'  => 'Instanz',
                        'width'    => '600px',
                        'moduleID' => $moduleGUID,
                        'visible'  => $visible,
                        'onChange' => self::MODULE_PREFIX . '_ModifyButton($id, "Configure' . $actionName . 'InstanceButton", "ID " . $Select' . $actionName . 'Instance . " konfigurieren", $Select' . $actionName . 'Instance);'
                    ],
                    //Configure instance
                    [
                        'type'     => 'OpenObjectButton',
                        'caption'  => 'Konfigurieren',
                        'name'     => 'Configure' . $actionName . 'InstanceButton',
                        'visible'  => false,
                        'objectID' => 0
                    ]
                ]
            ];

        //Status list
        $form['actions'][] =
            [
                'type'    => 'Label',
                'name'    => 'Label14',
                'caption' => 'Statusliste',
                'visible' => false
            ];

        $actionName = 'StatusList';
        $libraryGUID = self::STATUS_LIST_LIBRARY_GUID;
        $moduleGUID = self::STATUS_LIST_MODULE_GUID;

        $enabled = true;
        $visible = false;
        if (@IPS_LibraryExists($libraryGUID)) {
            $enabled = false;
            $visible = true;
        }

        $form['actions'][] =
            [
                'type'    => 'RowLayout',
                'name'    => 'Row16',
                'visible' => false,
                'items'   => [
                    //Add library
                    [
                        'type'    => 'Button',
                        'name'    => 'Add' . $actionName . 'LibraryButton',
                        'caption' => 'Bibliothek hinzufügen',
                        'onClick' => self::MODULE_PREFIX . '_AddLibrary($id, "' . $actionName . '");',
                        'enabled' => $enabled
                    ],
                    //Select module
                    [
                        'type'    => 'Select',
                        'name'    => 'Select' . $actionName . 'Module',
                        'caption' => 'Modul',
                        'width'   => '400px',
                        'visible' => $visible,
                        'options' => [
                            [
                                'caption' => 'Statusliste',
                                'value'   => $moduleGUID
                            ]
                        ],
                        'onChange' => self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "moduleID", $Select' . $actionName . 'Module);' . self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "value", 0);' . self::MODULE_PREFIX . '_UpdateField($id, "Configure' . $actionName . 'InstanceButton", "visible", false);',
                        'value'    => $moduleGUID
                    ],
                    //Create instance
                    [
                        'type'    => 'Button',
                        'name'    => 'Create' . $actionName . 'InstanceButton',
                        'caption' => 'Neue Instanz erstellen',
                        'onClick' => self::MODULE_PREFIX . '_CreateInstance($id, $Select' . $actionName . 'Module, $CategoryID);',
                        'visible' => $visible
                    ],
                    //Select instance
                    [
                        'type'     => 'SelectModule',
                        'name'     => 'Select' . $actionName . 'Instance',
                        'caption'  => 'Instanz',
                        'width'    => '600px',
                        'moduleID' => $moduleGUID,
                        'visible'  => $visible,
                        'onChange' => self::MODULE_PREFIX . '_ModifyButton($id, "Configure' . $actionName . 'InstanceButton", "ID " . $Select' . $actionName . 'Instance . " konfigurieren", $Select' . $actionName . 'Instance);'
                    ],
                    //Configure instance
                    [
                        'type'     => 'OpenObjectButton',
                        'caption'  => 'Konfigurieren',
                        'name'     => 'Configure' . $actionName . 'InstanceButton',
                        'visible'  => false,
                        'objectID' => 0
                    ]
                ]
            ];

        //Maintenance mode
        $form['actions'][] =
            [
                'type'    => 'Label',
                'name'    => 'Label15',
                'caption' => 'Wartungsmodus',
                'visible' => false
            ];

        $actionName = 'MaintenanceMode';
        $libraryGUID = self::MAINTENANCE_MODE_LIBRARY_GUID;
        $moduleGUID = self::MAINTENANCE_MODE_MODULE_GUID;

        $enabled = true;
        $visible = false;
        if (@IPS_LibraryExists($libraryGUID)) {
            $enabled = false;
            $visible = true;
        }

        $form['actions'][] =
            [
                'type'    => 'RowLayout',
                'name'    => 'Row17',
                'visible' => false,
                'items'   => [
                    //Add library
                    [
                        'type'    => 'Button',
                        'name'    => 'Add' . $actionName . 'LibraryButton',
                        'caption' => 'Bibliothek hinzufügen',
                        'onClick' => self::MODULE_PREFIX . '_AddLibrary($id, "' . $actionName . '");',
                        'enabled' => $enabled
                    ],
                    //Select module
                    [
                        'type'    => 'Select',
                        'name'    => 'Select' . $actionName . 'Module',
                        'caption' => 'Modul',
                        'width'   => '400px',
                        'visible' => $visible,
                        'options' => [
                            [
                                'caption' => 'Wartungsmodus',
                                'value'   => $moduleGUID
                            ]
                        ],
                        'onChange' => self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "moduleID", $Select' . $actionName . 'Module);' . self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "value", 0);' . self::MODULE_PREFIX . '_UpdateField($id, "Configure' . $actionName . 'InstanceButton", "visible", false);',
                        'value'    => $moduleGUID
                    ],
                    //Create instance
                    [
                        'type'    => 'Button',
                        'name'    => 'Create' . $actionName . 'InstanceButton',
                        'caption' => 'Neue Instanz erstellen',
                        'onClick' => self::MODULE_PREFIX . '_CreateInstance($id, $Select' . $actionName . 'Module, $CategoryID);',
                        'visible' => $visible
                    ],
                    //Select instance
                    [
                        'type'     => 'SelectModule',
                        'name'     => 'Select' . $actionName . 'Instance',
                        'caption'  => 'Instanz',
                        'width'    => '600px',
                        'moduleID' => $moduleGUID,
                        'visible'  => $visible,
                        'onChange' => self::MODULE_PREFIX . '_ModifyButton($id, "Configure' . $actionName . 'InstanceButton", "ID " . $Select' . $actionName . 'Instance . " konfigurieren", $Select' . $actionName . 'Instance);'
                    ],
                    //Configure instance
                    [
                        'type'     => 'OpenObjectButton',
                        'caption'  => 'Konfigurieren',
                        'name'     => 'Configure' . $actionName . 'InstanceButton',
                        'visible'  => false,
                        'objectID' => 0
                    ]
                ]
            ];

        //Warning indicator
        $form['actions'][] =
            [
                'type'    => 'Label',
                'name'    => 'Label16',
                'caption' => 'Warnmelder',
                'visible' => false
            ];

        $actionName = 'WarningIndicator';
        $libraryGUID = self::WARNING_INDICATOR_LIBRARY_GUID;
        $moduleGUID = self::WARNING_INDICATOR_MODULE_GUID;

        $enabled = true;
        $visible = false;
        if (@IPS_LibraryExists($libraryGUID)) {
            $enabled = false;
            $visible = true;
        }

        $form['actions'][] =
            [
                'type'    => 'RowLayout',
                'name'    => 'Row18',
                'visible' => false,
                'items'   => [
                    //Add library
                    [
                        'type'    => 'Button',
                        'name'    => 'Add' . $actionName . 'LibraryButton',
                        'caption' => 'Bibliothek hinzufügen',
                        'onClick' => self::MODULE_PREFIX . '_AddLibrary($id, "' . $actionName . '");',
                        'enabled' => $enabled
                    ],
                    //Select module
                    [
                        'type'    => 'Select',
                        'name'    => 'Select' . $actionName . 'Module',
                        'caption' => 'Modul',
                        'width'   => '400px',
                        'visible' => $visible,
                        'options' => [
                            [
                                'caption' => 'Warnmelder',
                                'value'   => $moduleGUID
                            ]
                        ],
                        'onChange' => self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "moduleID", $Select' . $actionName . 'Module);' . self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "value", 0);' . self::MODULE_PREFIX . '_UpdateField($id, "Configure' . $actionName . 'InstanceButton", "visible", false);',
                        'value'    => $moduleGUID
                    ],
                    //Create instance
                    [
                        'type'    => 'Button',
                        'name'    => 'Create' . $actionName . 'InstanceButton',
                        'caption' => 'Neue Instanz erstellen',
                        'onClick' => self::MODULE_PREFIX . '_CreateInstance($id, $Select' . $actionName . 'Module, $CategoryID);',
                        'visible' => $visible
                    ],
                    //Select instance
                    [
                        'type'     => 'SelectModule',
                        'name'     => 'Select' . $actionName . 'Instance',
                        'caption'  => 'Instanz',
                        'width'    => '600px',
                        'moduleID' => $moduleGUID,
                        'visible'  => $visible,
                        'onChange' => self::MODULE_PREFIX . '_ModifyButton($id, "Configure' . $actionName . 'InstanceButton", "ID " . $Select' . $actionName . 'Instance . " konfigurieren", $Select' . $actionName . 'Instance);'
                    ],
                    //Configure instance
                    [
                        'type'     => 'OpenObjectButton',
                        'caption'  => 'Konfigurieren',
                        'name'     => 'Configure' . $actionName . 'InstanceButton',
                        'visible'  => false,
                        'objectID' => 0
                    ]
                ]
            ];

        //Central status
        $form['actions'][] =
            [
                'type'    => 'Label',
                'name'    => 'Label17',
                'caption' => 'Zentralenstatus',
                'visible' => false
            ];

        $actionName = 'CentralStatus';
        $libraryGUID = self::CENTRAL_STATUS_LIBRARY_GUID;
        $moduleGUID = self::CENTRAL_STATUS_MODULE_GUID;

        $enabled = true;
        $visible = false;
        if (@IPS_LibraryExists($libraryGUID)) {
            $enabled = false;
            $visible = true;
        }

        $form['actions'][] =
            [
                'type'    => 'RowLayout',
                'name'    => 'Row19',
                'visible' => false,
                'items'   => [
                    //Add library
                    [
                        'type'    => 'Button',
                        'name'    => 'Add' . $actionName . 'LibraryButton',
                        'caption' => 'Bibliothek hinzufügen',
                        'onClick' => self::MODULE_PREFIX . '_AddLibrary($id, "' . $actionName . '");',
                        'enabled' => $enabled
                    ],
                    //Select module
                    [
                        'type'    => 'Select',
                        'name'    => 'Select' . $actionName . 'Module',
                        'caption' => 'Modul',
                        'width'   => '400px',
                        'visible' => $visible,
                        'options' => [
                            [
                                'caption' => 'Zentralenstatus',
                                'value'   => $moduleGUID
                            ]
                        ],
                        'onChange' => self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "moduleID", $Select' . $actionName . 'Module);' . self::MODULE_PREFIX . '_UpdateField($id, "Select' . $actionName . 'Instance", "value", 0);' . self::MODULE_PREFIX . '_UpdateField($id, "Configure' . $actionName . 'InstanceButton", "visible", false);',
                        'value'    => $moduleGUID
                    ],
                    //Create instance
                    [
                        'type'    => 'Button',
                        'name'    => 'Create' . $actionName . 'InstanceButton',
                        'caption' => 'Neue Instanz erstellen',
                        'onClick' => self::MODULE_PREFIX . '_CreateInstance($id, $Select' . $actionName . 'Module, $CategoryID);',
                        'visible' => $visible
                    ],
                    //Select instance
                    [
                        'type'     => 'SelectModule',
                        'name'     => 'Select' . $actionName . 'Instance',
                        'caption'  => 'Instanz',
                        'width'    => '600px',
                        'moduleID' => $moduleGUID,
                        'visible'  => $visible,
                        'onChange' => self::MODULE_PREFIX . '_ModifyButton($id, "Configure' . $actionName . 'InstanceButton", "ID " . $Select' . $actionName . 'Instance . " konfigurieren", $Select' . $actionName . 'Instance);'
                    ],
                    //Configure instance
                    [
                        'type'     => 'OpenObjectButton',
                        'caption'  => 'Konfigurieren',
                        'name'     => 'Configure' . $actionName . 'InstanceButton',
                        'visible'  => false,
                        'objectID' => 0
                    ]
                ]
            ];

        $form['actions'][] =
            [
                'type'    => 'Label',
                'caption' => ' '
            ];

        $form['actions'][] =
            [
                'type'    => 'Label',
                'caption' => ' '
            ];

        //Dummy info message
        $form['actions'][] =
            [
                'type'    => 'PopupAlert',
                'name'    => 'PopupAlert',
                'visible' => false,
                'popup'   => [
                    'closeCaption' => 'OK',
                    'items'        => [
                        [
                            'type'    => 'Label',
                            'name'    => 'PopupMessage',
                            'caption' => '',
                            'visible' => true
                        ],
                        [
                            'type'          => 'ProgressBar',
                            'name'          => 'PopupProgressBar',
                            'caption'       => 'Fortschritt',
                            'indeterminate' => true,
                            'visible'       => false
                        ]
                    ]
                ]
            ];

        return json_encode($form);
    }
}