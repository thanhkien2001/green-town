<?php

use Botble\Base\Facades\Form;
use Botble\Base\Facades\MetaBox;
use Botble\Base\Forms\FormAbstract;
use Botble\Base\Forms\FormHelper;
use Botble\Blog\Models\Post;
use Botble\Media\Facades\RvMedia;
use Botble\Page\Models\Page;
use Botble\Theme\Facades\Theme;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request as IlluminateRequest;
use Theme\Ripple\Fields\ThemeIconField;

register_page_template([
    'no-sidebar' => __('No sidebar'),
    'landing-page' => __('Landing Page'),
]);

register_sidebar([
    'id' => 'top_sidebar',
    'name' => __('Top sidebar'),
    'description' => __('Area for widgets on the top sidebar'),
]);

register_sidebar([
    'id' => 'footer_sidebar',
    'name' => __('Footer sidebar'),
    'description' => __('Area for footer widgets'),
]);

RvMedia::setUploadPathAndURLToPublic();
RvMedia::addSize('featured', 565, 375)->addSize('medium', 540, 360);

add_filter(BASE_FILTER_BEFORE_RENDER_FORM, function (FormAbstract $form, Model $data): FormAbstract {
    switch (get_class($data)) {
        case Post::class:
        case Page::class:
            $bannerImage = MetaBox::getMetaData($data, 'banner_image', true);

            $form
                ->addAfter('image', 'banner_image', is_in_admin(true) ? 'mediaImage' : 'customImage', [
                    'label' => __('Banner image (1920x170px)'),
                    'label_attr' => ['class' => 'control-label'],
                    'value' => $bannerImage,
                ]);

            break;
    }

    return $form;
}, 124, 3);

add_action(
    [BASE_ACTION_AFTER_CREATE_CONTENT, BASE_ACTION_AFTER_UPDATE_CONTENT],
    function (string $type, IlluminateRequest $request, Model $object): void {
        switch (get_class($object)) {
            case Post::class:
            case Page::class:
                if ($request->has('banner_image')) {
                    MetaBox::saveMetaBoxData($object, 'banner_image', $request->input('banner_image'));
                }

                break;
        }
    },
    175,
    3
);

Form::component('themeIcon', Theme::getThemeNamespace() . '::partials.icons-field', [
    'name',
    'value' => null,
    'attributes' => [],
]);

add_filter('form_custom_fields', function (FormAbstract $form, FormHelper $formHelper): FormAbstract {
    if (! $formHelper->hasCustomField('themeIcon')) {
        $form->addCustomField('themeIcon', ThemeIconField::class);
    }

    return $form;
}, 29, 2);

app()->booted(function () {
    \Botble\Base\Facades\DashboardMenu::removeItem('cms-plugins-block')
        ->removeItem('cms-core-member')
        ->removeItem('cms-core-plugins');
});

// ─── Landing Page Theme Options ───────────────────────────────────────────────

theme_option()
    // Section 1
    ->setSection([
        'title'      => 'Landing Page: S1 Hero',
        'desc'       => 'Cấu hình Section 1 (Banner Hero)',
        'priority'   => 10,
        'id'         => 'opt-section-landing-s1',
        'subsection' => true,
        'icon'       => 'fa fa-home',
        'fields'     => [
            [
                'id'         => 'ldp_s1_bg',
                'type'       => 'mediaImage',
                'label'      => 'Ảnh nền Section 1 (Hero Banner)',
                'attributes' => [
                    'name'  => 'ldp_s1_bg',
                    'value' => null,
                ],
            ],
        ],
    ])
    // Section 2
    ->setSection([
        'title'      => 'Landing Page: S2 Overview',
        'desc'       => 'Cấu hình Section 2 (Thông tin tổng quan)',
        'priority'   => 11,
        'id'         => 'opt-section-landing-s2',
        'subsection' => true,
        'icon'       => 'fa fa-info-circle',
        'fields'     => [
            [
                'id'         => 'ldp_s2_bg',
                'type'       => 'mediaImage',
                'label'      => 'Ảnh nền Section 2',
                'attributes' => [
                    'name'  => 'ldp_s2_bg',
                    'value' => null,
                ],
            ],
            [
                'id'         => 'ldp_s2_title',
                'type'       => 'text',
                'label'      => 'Tiêu đề chính',
                'attributes' => [
                    'name'    => 'ldp_s2_title',
                    'value'   => 'THÔNG TIN TỔNG QUAN',
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id'         => 'ldp_s2_col1_title',
                'type'       => 'text',
                'label'      => 'Tiêu đề Cột 1',
                'attributes' => [
                    'name'    => 'ldp_s2_col1_title',
                    'value'   => 'SOLENA',
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id'         => 'ldp_s2_col1_items',
                'type'       => 'repeater',
                'label'      => 'Thông tin Cột 1',
                'attributes' => [
                    'name'    => 'ldp_s2_col1_items',
                    'value'   => null,
                    'fields'  => [
                        [
                            'type'       => 'text',
                            'label'      => 'Tiêu đề dòng (Label)',
                            'attributes' => [
                                'name'    => 'label',
                                'value'   => null,
                                'options' => [
                                    'class' => 'form-control',
                                ],
                            ],
                        ],
                        [
                            'type'       => 'text',
                            'label'      => 'Nội dung (Value)',
                            'attributes' => [
                                'name'    => 'value',
                                'value'   => null,
                                'options' => [
                                    'class' => 'form-control',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'id'         => 'ldp_s2_col2_title',
                'type'       => 'text',
                'label'      => 'Tiêu đề Cột 2',
                'attributes' => [
                    'name'    => 'ldp_s2_col2_title',
                    'value'   => 'GREEN TOWN BÌNH TÂN',
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id'         => 'ldp_s2_col2_items',
                'type'       => 'repeater',
                'label'      => 'Thông tin Cột 2',
                'attributes' => [
                    'name'    => 'ldp_s2_col2_items',
                    'value'   => null,
                    'fields'  => [
                        [
                            'type'       => 'text',
                            'label'      => 'Tiêu đề dòng (Label)',
                            'attributes' => [
                                'name'    => 'label',
                                'value'   => null,
                                'options' => [
                                    'class' => 'form-control',
                                ],
                            ],
                        ],
                        [
                            'type'       => 'text',
                            'label'      => 'Nội dung (Value)',
                            'attributes' => [
                                'name'    => 'value',
                                'value'   => null,
                                'options' => [
                                    'class' => 'form-control',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ])

    // Section 3: Vị trí & Kết nối
    ->setSection([
        'title'      => 'Landing Page: S3 Location',
        'desc'       => 'Cấu hình Section 3 (Vị trí & Kết nối)',
        'priority'   => 12,
        'id'         => 'opt-section-landing-s3',
        'subsection' => true,
        'icon'       => 'fa fa-map-marker',
        'fields'     => [
            [
                'id'         => 'ldp_s3_bg',
                'type'       => 'mediaImage',
                'label'      => 'Ảnh nền Section 3 (Desktop)',
                'attributes' => [
                    'name'  => 'ldp_s3_bg',
                    'value' => null,
                ],
            ],
            [
                'id'         => 'ldp_s3_bg_mb',
                'type'       => 'mediaImage',
                'label'      => 'Ảnh nền Section 3 (Mobile)',
                'attributes' => [
                    'name'  => 'ldp_s3_bg_mb',
                    'value' => null,
                ],
            ],
            [
                'id'         => 'ldp_s3_left_title1',
                'type'       => 'text',
                'label'      => 'Cột Trái: Tiêu đề 1 (Màu vàng)',
                'attributes' => [
                    'name'    => 'ldp_s3_left_title1',
                    'value'   => 'KHU ĐÔ THỊ VĨNH LỘC QUY MÔ 110HA',
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id'         => 'ldp_s3_left_title2',
                'type'       => 'text',
                'label'      => 'Cột Trái: Tiêu đề 2 (Màu trắng)',
                'attributes' => [
                    'name'    => 'ldp_s3_left_title2',
                    'value'   => 'KHU ĐÔ THỊ KIỂU MẪU - "PHÚ MỸ HƯNG THỨ 2" TẠI KHU TÂY TP.HCM',
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id'         => 'ldp_s3_left_desc',
                'type'       => 'textarea',
                'label'      => 'Cột Trái: Mô tả',
                'attributes' => [
                    'name'    => 'ldp_s3_left_desc',
                    'value'   => 'Khu đô thị Vĩnh Lộc là một trong những khu đô thị quy mô lớn đầu tiên tại khu Tây TP.HCM. Dự án được quy hoạch đồng bộ trên diện tích khoảng 110 ha với mục tiêu hình thành một khu đô thị hoàn chỉnh gồm nhà ở, thương mại, giáo dục, y tế, công viên và hạ tầng kỹ thuật.',
                    'options' => [
                        'class' => 'form-control',
                        'rows'  => 4,
                    ],
                ],
            ],
            [
                'id'         => 'ldp_s3_right_title1',
                'type'       => 'text',
                'label'      => 'Cột Phải: Tiêu đề 1 (Màu trắng lớn)',
                'attributes' => [
                    'name'    => 'ldp_s3_right_title1',
                    'value'   => 'GREEN TOWN BÌNH TÂN',
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id'         => 'ldp_s3_right_title2',
                'type'       => 'text',
                'label'      => 'Cột Phải: Tiêu đề 2 (Màu trắng nhỏ)',
                'attributes' => [
                    'name'    => 'ldp_s3_right_title2',
                    'value'   => 'LANDMARK DÂN CƯ CỦA KHU ĐÔ THỊ VĨNH LỘC',
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
        ],
    ]);

    // // Section 4
    // ->setSection([
    //     'title'      => 'Landing Page: S4 Form',
    //     'desc'       => 'Cấu hình Section 4 (Form)',
    //     'priority'   => 13,
    //     'id'         => 'opt-section-landing-s4',
    //     'subsection' => true,
    //     'icon'       => 'fa fa-wpforms',
    //     'fields'     => [
    //         [
    //             'id'         => 'ldp_s4_bg',
    //             'type'       => 'mediaImage',
    //             'label'      => 'Background Desktop (Section 4)',
    //             'attributes' => [
    //                 'name'  => 'ldp_s4_bg',
    //                 'value' => null,
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s4_bg_mb',
    //             'type'       => 'mediaImage',
    //             'label'      => 'Background Mobile (Section 4)',
    //             'attributes' => [
    //                 'name'  => 'ldp_s4_bg_mb',
    //                 'value' => null,
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s4_subtitle',
    //             'type'       => 'text',
    //             'label'      => 'Dòng giới thiệu nhỏ (Subtitle)',
    //             'attributes' => [
    //                 'name'    => 'ldp_s4_subtitle',
    //                 'value'   => null,
    //                 'options' => [
    //                     'class'       => 'form-control',
    //                     'placeholder' => 'Đăng ký ngay hôm nay để bắt đầu hành trình khám phá',
    //                 ],
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s4_title',
    //             'type'       => 'text',
    //             'label'      => 'Tiêu đề chính (Title)',
    //             'attributes' => [
    //                 'name'    => 'ldp_s4_title',
    //                 'value'   => null,
    //                 'options' => [
    //                     'class'       => 'form-control',
    //                     'placeholder' => 'Kỷ nguyên mới - Công nghệ mới',
    //                 ],
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s4_btn_text',
    //             'type'       => 'text',
    //             'label'      => 'Chữ hiển thị trên Nút Đăng ký',
    //             'attributes' => [
    //                 'name'    => 'ldp_s4_btn_text',
    //                 'value'   => null,
    //                 'options' => [
    //                     'class'       => 'form-control',
    //                     'placeholder' => 'Đăng ký ngay',
    //                 ],
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s4_link1_text',
    //             'type'       => 'text',
    //             'label'      => 'Footer Link 1: Text',
    //             'attributes' => [
    //                 'name'    => 'ldp_s4_link1_text',
    //                 'value'   => null,
    //                 'options' => [
    //                     'class'       => 'form-control',
    //                     'placeholder' => 'Đại lý gần nhất',
    //                 ],
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s4_link1_url',
    //             'type'       => 'text',
    //             'label'      => 'Footer Link 1: URL',
    //             'attributes' => [
    //                 'name'    => 'ldp_s4_link1_url',
    //                 'value'   => null,
    //                 'options' => [
    //                     'class'       => 'form-control',
    //                     'placeholder' => '#dealer',
    //                 ],
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s4_link2_text',
    //             'type'       => 'text',
    //             'label'      => 'Footer Link 2: Text',
    //             'attributes' => [
    //                 'name'    => 'ldp_s4_link2_text',
    //                 'value'   => null,
    //                 'options' => [
    //                     'class'       => 'form-control',
    //                     'placeholder' => 'Sản phẩm',
    //                 ],
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s4_link2_url',
    //             'type'       => 'text',
    //             'label'      => 'Footer Link 2: URL',
    //             'attributes' => [
    //                 'name'    => 'ldp_s4_link2_url',
    //                 'value'   => null,
    //                 'options' => [
    //                     'class'       => 'form-control',
    //                     'placeholder' => '#products',
    //                 ],
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s4_link3_text',
    //             'type'       => 'text',
    //             'label'      => 'Footer Link 3: Text',
    //             'attributes' => [
    //                 'name'    => 'ldp_s4_link3_text',
    //                 'value'   => null,
    //                 'options' => [
    //                     'class'       => 'form-control',
    //                     'placeholder' => 'Liên hệ',
    //                 ],
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s4_link3_url',
    //             'type'       => 'text',
    //             'label'      => 'Footer Link 3: URL',
    //             'attributes' => [
    //                 'name'    => 'ldp_s4_link3_url',
    //                 'value'   => null,
    //                 'options' => [
    //                     'class'       => 'form-control',
    //                     'placeholder' => '#contact',
    //                 ],
    //             ],
    //         ],
    //     ],
    // ])

    // Section 5
    theme_option()->setSection([
        'title'      => 'Landing Page: S5 Features',
        'desc'       => 'Cấu hình Section 5 (Quyết định lên đời)',
        'priority'   => 14,
        'id'         => 'opt-section-landing-s5',
        'subsection' => true,
        'icon'       => 'fa fa-list',
        'fields'     => [
            [
                'id'         => 'ldp_s5_heading',
                'type'       => 'text',
                'label'      => 'Tiêu đề chính',
                'attributes' => [
                    'name'    => 'ldp_s5_heading',
                    'value'   => null,
                    'options' => [
                        'class'       => 'form-control',
                        'placeholder' => 'QUYẾT ĐỊNH LÊN ĐỜI CÙNG SOLENA BY GREEN TOWN',
                    ],
                ],
            ],
            [
                'id'         => 'ldp_s5_f1_title',
                'type'       => 'text',
                'label'      => 'Feature 1: Tiêu đề',
                'attributes' => [
                    'name'    => 'ldp_s5_f1_title',
                    'value'   => null,
                    'options' => [
                        'class'       => 'form-control',
                        'placeholder' => 'MẢNH GHÉP MỚI',
                    ],
                ],
            ],
            [
                'id'         => 'ldp_s5_f1_desc',
                'type'       => 'textarea',
                'label'      => 'Feature 1: Mô tả',
                'attributes' => [
                    'name'    => 'ldp_s5_f1_desc',
                    'value'   => null,
                    'options' => [
                        'class'       => 'form-control',
                        'rows'        => 3,
                    ],
                ],
            ],
            [
                'id'         => 'ldp_s5_f2_title',
                'type'       => 'text',
                'label'      => 'Feature 2: Tiêu đề',
                'attributes' => [
                    'name'    => 'ldp_s5_f2_title',
                    'value'   => null,
                    'options' => [
                        'class'       => 'form-control',
                    ],
                ],
            ],
            [
                'id'         => 'ldp_s5_f2_desc',
                'type'       => 'textarea',
                'label'      => 'Feature 2: Mô tả',
                'attributes' => [
                    'name'    => 'ldp_s5_f2_desc',
                    'value'   => null,
                    'options' => [
                        'class'       => 'form-control',
                        'rows'        => 3,
                    ],
                ],
            ],
            [
                'id'         => 'ldp_s5_f3_title',
                'type'       => 'text',
                'label'      => 'Feature 3: Tiêu đề',
                'attributes' => [
                    'name'    => 'ldp_s5_f3_title',
                    'value'   => null,
                    'options' => [
                        'class'       => 'form-control',
                    ],
                ],
            ],
            [
                'id'         => 'ldp_s5_f3_desc',
                'type'       => 'textarea',
                'label'      => 'Feature 3: Mô tả',
                'attributes' => [
                    'name'    => 'ldp_s5_f3_desc',
                    'value'   => null,
                    'options' => [
                        'class'       => 'form-control',
                        'rows'        => 3,
                    ],
                ],
            ],
            [
                'id'         => 'ldp_s5_f4_title',
                'type'       => 'text',
                'label'      => 'Feature 4: Tiêu đề',
                'attributes' => [
                    'name'    => 'ldp_s5_f4_title',
                    'value'   => null,
                    'options' => [
                        'class'       => 'form-control',
                    ],
                ],
            ],
            [
                'id'         => 'ldp_s5_f4_desc',
                'type'       => 'textarea',
                'label'      => 'Feature 4: Mô tả',
                'attributes' => [
                    'name'    => 'ldp_s5_f4_desc',
                    'value'   => null,
                    'options' => [
                        'class'       => 'form-control',
                        'rows'        => 3,
                    ],
                ],
            ],
            [
                'id'         => 'ldp_s5_f5_title',
                'type'       => 'text',
                'label'      => 'Feature 5: Tiêu đề',
                'attributes' => [
                    'name'    => 'ldp_s5_f5_title',
                    'value'   => null,
                    'options' => [
                        'class'       => 'form-control',
                    ],
                ],
            ],
            [
                'id'         => 'ldp_s5_f5_desc',
                'type'       => 'textarea',
                'label'      => 'Feature 5: Mô tả',
                'attributes' => [
                    'name'    => 'ldp_s5_f5_desc',
                    'value'   => null,
                    'options' => [
                        'class'       => 'form-control',
                        'rows'        => 3,
                    ],
                ],
            ],
        ],
    ]);


    theme_option()->setSection([
        'title'      => 'Landing Page: Section 6',
        'desc'       => 'Cấu hình nội dung cho Section 6 (Tiện ích nội khu)',
        'id'         => 'opt-text-subsection-landing-page-s6',
        'subsection' => true,
        'icon'       => 'fas fa-star',
        'fields'     => [
            [
                'id'         => 'ldp_s6_heading1',
                'type'       => 'text',
                'label'      => 'Tiêu đề lớn (20 TIỆN ÍCH NỘI KHU)',
                'attributes' => [
                    'name'    => 'ldp_s6_heading1',
                    'value'   => '20 TIỆN ÍCH NỘI KHU',
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id'         => 'ldp_s6_heading2',
                'type'       => 'text',
                'label'      => 'Tiêu đề nhỏ (ĐẶC QUYỀN...)',
                'attributes' => [
                    'name'    => 'ldp_s6_heading2',
                    'value'   => 'ĐẶC QUYỀN DÀNH RIÊNG CHO CƯ DÂN',
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            // Slider items
            ...array_merge(...array_map(function($i) {
                return [
                    [
                        'id'         => 'ldp_s6_img'.$i,
                        'type'       => 'mediaImage',
                        'label'      => 'Hình ảnh Slider '.$i,
                        'attributes' => [
                            'name'  => 'ldp_s6_img'.$i,
                            'value' => null,
                        ],
                    ],
                    [
                        'id'         => 'ldp_s6_title'.$i,
                        'type'       => 'text',
                        'label'      => 'Tiêu đề Slider '.$i,
                        'attributes' => [
                            'name'    => 'ldp_s6_title'.$i,
                            'value'   => null,
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ],
                    ]
                ];
            }, range(1, 5)))
        ],
    ]);

    theme_option()->setSection([
        'title'      => 'Landing Page: Section 7',
        'desc'       => 'Cấu hình nội dung cho Section 7 (Mặt bằng)',
        'id'         => 'opt-text-subsection-landing-page-s7',
        'subsection' => true,
        'icon'       => 'fas fa-map',
        'fields'     => [
            [
                'id'         => 'ldp_s7_heading1',
                'type'       => 'textarea',
                'label'      => 'Tiêu đề lớn (Có thể dùng Enter để xuống dòng)',
                'attributes' => [
                    'name'    => 'ldp_s7_heading1',
                    'value'   => "MẶT BẰNG TẦNG ĐIỂN HÌNH\nSOLENA BY GREEN TOWN",
                    'options' => [
                        'class' => 'form-control',
                        'rows'  => 3,
                    ],
                ],
            ],
            [
                'id'         => 'ldp_s7_img',
                'type'       => 'mediaImage',
                'label'      => 'Hình ảnh mặt bằng',
                'attributes' => [
                    'name'  => 'ldp_s7_img',
                    'value' => null,
                ],
            ],
        ],
    ]);
