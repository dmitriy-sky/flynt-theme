<?php

namespace Flynt\Components\ListSocial;

use Flynt\FieldVariables;
use Flynt\ComponentManager;
use Flynt\Utils\Asset;

add_filter('Flynt/addComponentData?name=ListSocial', function ($data) {
    if (!empty($data['social'])) {
        $data['social'] = array_map(function ($item) {
            $componentManager = ComponentManager::getInstance();
            $componentPathFull = $componentManager->getComponentDirPath('ListSocial');
            $componentPath = str_replace(trailingslashit(get_template_directory()), '', $componentPathFull);
            $item['icon'] = Asset::getContents("{$componentPath}Assets/{$item['platform']}.svg");
            return $item;
        }, $data['social']);
    }

    return $data;
});

function getACFLayout()
{
    return [
        'name' => 'listSocial',
        'label' => 'List: Social',
        'sub_fields' => [
            [
                'label' => 'General',
                'name' => 'generalTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0
            ],
            [
                'label' => 'Content',
                'name' => 'contentHtml',
                'type' => 'wysiwyg',
                'tabs' => 'visual,text',
                'media_upload' => 0,
                'delay' => 1,
                'wrapper' => [
                    'class' => 'autosize',
                ],
            ],
            [
                'label' => 'Social Platform',
                'type' => 'repeater',
                'name' => 'social',
                'layout' => 'table',
                'button_label' => 'Add Social Link',
                'sub_fields' => [
                    [
                        'label' => 'Platform',
                        'name' => 'platform',
                        'type' => 'select',
                        'allow_null' => 0,
                        'multiple' => 0,
                        'ui' => 1,
                        'ajax' => 0,
                        'choices' => [
                            'facebook' => 'Facebook',
                            'instagram' => 'Instagram',
                            'twitter' => 'Twitter',
                            'youtube' => 'Youtube',
                            'mail' => 'E-Mail',
                            'linkedin' => 'LinkedIn',
                            'xing' => 'Xing'
                        ]
                    ],
                    [
                        'label' => 'Link',
                        'name' => 'url',
                        'type' => 'url',
                        'required' => 1
                    ]
                ]
            ],
            [
                'label' => 'Options',
                'name' => 'optionsTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0
            ],
            [
                'label' => '',
                'name' => 'options',
                'type' => 'group',
                'layout' => 'row',
                'sub_fields' => [
                    FieldVariables\getTheme()
                ]
            ]
        ]
    ];
}
