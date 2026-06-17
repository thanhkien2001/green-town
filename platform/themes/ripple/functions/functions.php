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
    // Header Menu
    ->setSection([
        'title'      => 'Header Menu',
        'desc'       => 'Cấu hình Menu Header và Logos cho Landing Page',
        'priority'   => 9,
        'id'         => 'opt-section-landing-header',
        'subsection' => true,
        'icon'       => 'fa fa-bars',
        'fields'     => [
            [
                'id'         => 'ldp_header_logo1',
                'type'       => 'mediaImage',
                'label'      => 'Logo 1 (Bên trái)',
                'attributes' => [
                    'name'  => 'ldp_header_logo1',
                    'value' => null,
                ],
            ],
            [
                'id'         => 'ldp_header_logo2',
                'type'       => 'mediaImage',
                'label'      => 'Logo 2 (Bên trái, cạnh Logo 1)',
                'attributes' => [
                    'name'  => 'ldp_header_logo2',
                    'value' => null,
                ],
            ],
            [
                'id'         => 'ldp_header_menu',
                'type'       => 'repeater',
                'label'      => 'Danh sách Menu liên kết',
                'attributes' => [
                    'name'    => 'ldp_header_menu',
                    'value'   => null,
                    'fields'  => [
                        [
                            'type'       => 'text',
                            'label'      => 'Tên Menu (Ví dụ: Vị trí)',
                            'attributes' => [
                                'name'    => 'title',
                                'value'   => null,
                                'options' => [
                                    'class' => 'form-control',
                                ],
                            ],
                        ],
                        [
                            'type'       => 'text',
                            'label'      => 'Liên kết Section ID (Ví dụ: #section-utilities)',
                            'attributes' => [
                                'name'    => 'anchor',
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
                'label'      => 'Ảnh nền Section 1 (Hero Banner - PC)',
                'attributes' => [
                    'name'  => 'ldp_s1_bg',
                    'value' => null,
                ],
            ],
            [
                'id'         => 'ldp_s1_bg_mobile',
                'type'       => 'mediaImage',
                'label'      => 'Ảnh nền Section 1 (Mobile)',
                'attributes' => [
                    'name'  => 'ldp_s1_bg_mobile',
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
                'id'         => 'ldp_s2_bg_mobile',
                'type'       => 'mediaImage',
                'label'      => 'Ảnh nền Section 2 (Mobile)',
                'attributes' => [
                    'name'  => 'ldp_s2_bg_mobile',
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
                'id'         => 'ldp_s3_bg_mobile',
                'type'       => 'mediaImage',
                'label'      => 'Ảnh nền Section 3 (Mobile)',
                'attributes' => [
                    'name'  => 'ldp_s3_bg_mobile',
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

    // Section 4: Kết nối tiện ích
    theme_option()->setSection([
        'title'      => 'Landing Page: S4 Utilities',
        'desc'       => 'Cấu hình Section 4 (Kết nối tiện ích)',
        'priority'   => 13,
        'id'         => 'opt-section-landing-s4',
        'subsection' => true,
        'icon'       => 'fa fa-map-signs',
        'fields'     => [
            [
                'id'         => 'ldp_s4_map_img',
                'type'       => 'mediaImage',
                'label'      => 'Ảnh bản đồ bên trái (Desktop & Mobile)',
                'attributes' => [
                    'name'  => 'ldp_s4_map_img',
                    'value' => null,
                ],
            ],
            [
                'id'         => 'ldp_s4_title',
                'type'       => 'text',
                'label'      => 'Tiêu đề lớn (Title)',
                'attributes' => [
                    'name'    => 'ldp_s4_title',
                    'value'   => 'GREEN TOWN BÌNH TÂN',
                    'options' => [
                        'class'       => 'form-control',
                        'placeholder' => 'GREEN TOWN BÌNH TÂN',
                    ],
                ],
            ],
            [
                'id'         => 'ldp_s4_subtitle',
                'type'       => 'text',
                'label'      => 'Tiêu đề phụ (Subtitle)',
                'attributes' => [
                    'name'    => 'ldp_s4_subtitle',
                    'value'   => 'ĐÔ THỊ 15 PHÚT PHÍA TÂY TP. HỒ CHÍ MINH',
                    'options' => [
                        'class'       => 'form-control',
                        'placeholder' => 'ĐÔ THỊ 15 PHÚT PHÍA TÂY TP. HỒ CHÍ MINH',
                    ],
                ],
            ],
            [
                'id'         => 'ldp_s4_items',
                'type'       => 'textarea',
                'label'      => 'Danh sách tiện ích (Mỗi dòng là một tiện ích)',
                'attributes' => [
                    'name'    => 'ldp_s4_items',
                    'value'   => "Chỉ 300m tới trung tâm hành chính Bình Hưng Hoà\nChỉ 500m tới trường học các cấp: Trường mầm non - tiểu học Trí Tuệ Việt, Trường Tiểu học Ngô Quyền, Trường THPT Vĩnh Lộc, THCS Huỳnh Văn Nghệ...\nĐối diện công viên hồ trái tim.\nLiền kề trung tâm thể dục thể thao.\n5 phút tới trung tâm thương mại AEON Mall Tân Phú\n5 phút tới trung tâm thương mại Pandora City\n7 phút tới Bến xe An Sương\n10 phút tới Sân bay Tân Sơn Nhất\n10 phút tới KCN Vĩnh Lộc, KCN Tân Bình, KCN Tân Tạo\n10 phút tới Tòa nhà Etown Tower phường Tân Bình",
                    'options' => [
                        'class' => 'form-control',
                        'rows'  => 12,
                    ],
                ],
            ],
        ],
    ]);

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
        'priority'   => 15,
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
        'priority'   => 16,
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

    
    theme_option()->setSection([
        'title'      => 'Landing Page: Section 8',
        'desc'       => 'Cấu hình nội dung cho Section 8 (Layout căn hộ)',
        'id'         => 'opt-text-subsection-landing-page-s8',
        'subsection' => true,
        'priority'   => 17,
        'icon'       => 'fas fa-th-large',
        'fields'     => [
            [
                'id'         => 'ldp_s8_heading',
                'type'       => 'text',
                'label'      => 'Tiêu đề',
                'attributes' => [
                    'name'    => 'ldp_s8_heading',
                    'value'   => 'LAYOUT CĂN HỘ ĐIỂN HÌNH',
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id'         => 'ldp_s8_kid_img',
                'type'       => 'mediaImage',
                'label'      => 'Hình em bé (Góc phải trên)',
                'attributes' => [
                    'name'  => 'ldp_s8_kid_img',
                    'value' => null,
                ],
            ],
            [
                'id'         => 'ldp_s8_img1',
                'type'       => 'mediaImage',
                'label'      => 'Hình Layout 1',
                'attributes' => [
                    'name'  => 'ldp_s8_img1',
                    'value' => null,
                ],
            ],
            [
                'id'         => 'ldp_s8_title1',
                'type'       => 'text',
                'label'      => 'Tiêu đề Layout 1',
                'attributes' => [
                    'name'    => 'ldp_s8_title1',
                    'value'   => 'CĂN HỘ LOẠI A',
                    'options' => ['class' => 'form-control'],
                ],
            ],
            [
                'id'         => 'ldp_s8_desc1',
                'type'       => 'text',
                'label'      => 'Mô tả Layout 1',
                'attributes' => [
                    'name'    => 'ldp_s8_desc1',
                    'value'   => '(2PN1WC)',
                    'options' => ['class' => 'form-control'],
                ],
            ],
            [
                'id'         => 'ldp_s8_img2',
                'type'       => 'mediaImage',
                'label'      => 'Hình Layout 2',
                'attributes' => [
                    'name'  => 'ldp_s8_img2',
                    'value' => null,
                ],
            ],
            [
                'id'         => 'ldp_s8_title2',
                'type'       => 'text',
                'label'      => 'Tiêu đề Layout 2',
                'attributes' => [
                    'name'    => 'ldp_s8_title2',
                    'value'   => 'CĂN HỘ LOẠI B',
                    'options' => ['class' => 'form-control'],
                ],
            ],
            [
                'id'         => 'ldp_s8_desc2',
                'type'       => 'text',
                'label'      => 'Mô tả Layout 2',
                'attributes' => [
                    'name'    => 'ldp_s8_desc2',
                    'value'   => '(2PN2WC <70M2)',
                    'options' => ['class' => 'form-control'],
                ],
            ],
            [
                'id'         => 'ldp_s8_img3',
                'type'       => 'mediaImage',
                'label'      => 'Hình Layout 3',
                'attributes' => [
                    'name'  => 'ldp_s8_img3',
                    'value' => null,
                ],
            ],
            [
                'id'         => 'ldp_s8_title3',
                'type'       => 'text',
                'label'      => 'Tiêu đề Layout 3',
                'attributes' => [
                    'name'    => 'ldp_s8_title3',
                    'value'   => 'CĂN HỘ LOẠI C',
                    'options' => ['class' => 'form-control'],
                ],
            ],
            [
                'id'         => 'ldp_s8_desc3',
                'type'       => 'text',
                'label'      => 'Mô tả Layout 3',
                'attributes' => [
                    'name'    => 'ldp_s8_desc3',
                    'value'   => '(2PN2WC >70M2)',
                    'options' => ['class' => 'form-control'],
                ],
            ],
            [
                'id'         => 'ldp_s8_img4',
                'type'       => 'mediaImage',
                'label'      => 'Hình Layout 4',
                'attributes' => [
                    'name'  => 'ldp_s8_img4',
                    'value' => null,
                ],
            ],
            [
                'id'         => 'ldp_s8_title4',
                'type'       => 'text',
                'label'      => 'Tiêu đề Layout 4',
                'attributes' => [
                    'name'    => 'ldp_s8_title4',
                    'value'   => 'CĂN HỘ LOẠI D',
                    'options' => ['class' => 'form-control'],
                ],
            ],
            [
                'id'         => 'ldp_s8_desc4',
                'type'       => 'text',
                'label'      => 'Mô tả Layout 4',
                'attributes' => [
                    'name'    => 'ldp_s8_desc4',
                    'value'   => '(3PN2WC)',
                    'options' => ['class' => 'form-control'],
                ],
            ],
        ],
    ]);

    theme_option()->setSection([
        'title'      => 'Landing Page: Section 9',
        'priority'   => 18,
        'desc'       => 'Cấu hình nội dung cho Section 9 (Pháp lý hoàn chỉnh)',
        'id'         => 'opt-text-subsection-landing-page-s9',
        'subsection' => true,
        'icon'       => 'fas fa-balance-scale',
        'fields'     => [
            [
                'id'         => 'ldp_s9_bg',
                'type'       => 'mediaImage',
                'label'      => 'Hình nền chính (Section 9)',
                'attributes' => [
                    'name'  => 'ldp_s9_bg',
                    'value' => null,
                ],
            ],
            [
                'id'         => 'ldp_s9_bg_mobile',
                'type'       => 'mediaImage',
                'label'      => 'Hình nền chính (Mobile)',
                'attributes' => [
                    'name'  => 'ldp_s9_bg_mobile',
                    'value' => null,
                ],
            ],
            [
                'id'         => 'ldp_s9_heading',
                'type'       => 'textarea',
                'label'      => 'Tiêu đề (Có thể dùng Enter để xuống dòng)',
                'attributes' => [
                    'name'    => 'ldp_s9_heading',
                    'value'   => "PHÁP LÝ HOÀN CHỈNH\nAN CƯ BỀN VỮNG",
                    'options' => [
                        'class' => 'form-control',
                        'rows'  => 3,
                    ],
                ],
            ],
            [
                'id'         => 'ldp_s9_btn_text',
                'type'       => 'text',
                'label'      => 'Chữ trên nút',
                'attributes' => [
                    'name'    => 'ldp_s9_btn_text',
                    'value'   => 'XEM CHI TIẾT',
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id'         => 'ldp_s9_btn_link',
                'type'       => 'text',
                'label'      => 'Link của nút',
                'attributes' => [
                    'name'    => 'ldp_s9_btn_link',
                    'value'   => '#',
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id'         => 'ldp_s9_kid_img',
                'type'       => 'mediaImage',
                'label'      => 'Hình em bé (Góc phải dưới)',
                'attributes' => [
                    'name'  => 'ldp_s9_kid_img',
                    'value' => null,
                ],
            ],
        ],
    ]);

    theme_option()->setSection([
        'title'      => 'Landing Page: Section 10',
        'priority'   => 19,
        'desc'       => 'Cấu hình nội dung cho Section 10 (Phương thức thanh toán)',
        'id'         => 'opt-text-subsection-landing-page-s10',
        'subsection' => true,
        'icon'       => 'fas fa-money-check-alt',
        'fields'     => [
            [
                'id'         => 'ldp_s10_heading',
                'type'       => 'text',
                'label'      => 'Tiêu đề',
                'attributes' => [
                    'name'    => 'ldp_s10_heading',
                    'value'   => 'PHƯƠNG THỨC THANH TOÁN',
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id'         => 'ldp_s10_img_1',
                'type'       => 'mediaImage',
                'label'      => 'Hình ảnh phương thức thanh toán 1',
                'attributes' => [
                    'name'  => 'ldp_s10_img_1',
                    'value' => null,
                ],
            ],
            [
                'id'         => 'ldp_s10_img_2',
                'type'       => 'mediaImage',
                'label'      => 'Hình ảnh phương thức thanh toán 2',
                'attributes' => [
                    'name'  => 'ldp_s10_img_2',
                    'value' => null,
                ],
            ],
        ],
    ]);
        theme_option()->setSection([
        'title'      => 'Landing Page: Section 11',
        'priority'   => 20,
        'desc'       => 'Cấu hình nội dung cho Section 11 (Slider Hình Ảnh)',
        'id'         => 'opt-text-subsection-landing-page-s11',
        'subsection' => true,
        'icon'       => 'fas fa-images',
        'fields'     => [
            [
                'id'         => 'ldp_s11_rows',
                'type'       => 'repeater',
                'label'      => 'Các hàng Slider',
                'attributes' => [
                    'name'   => 'ldp_s11_rows',
                    'value'  => null,
                    'fields' => [
                        [
                            'type'       => 'text',
                            'label'      => 'Tiêu đề chính (Title)',
                            'attributes' => [
                                'name'    => 'title',
                                'value'   => null,
                                'options' => [
                                    'class' => 'form-control',
                                ],
                            ],
                        ],
                        [
                            'type'       => 'text',
                            'label'      => 'Tiêu đề phụ (Subtitle - nếu có)',
                            'attributes' => [
                                'name'    => 'subtitle',
                                'value'   => null,
                                'options' => [
                                    'class' => 'form-control',
                                ],
                            ],
                        ],
                        [
                            'type'       => 'mediaImage',
                            'label'      => 'Hình ảnh 1',
                            'attributes' => [
                                'name'  => 'image_1',
                                'value' => null,
                            ],
                        ],
                        [
                            'type'       => 'mediaImage',
                            'label'      => 'Hình ảnh 2',
                            'attributes' => [
                                'name'  => 'image_2',
                                'value' => null,
                            ],
                        ],
                        [
                            'type'       => 'mediaImage',
                            'label'      => 'Hình ảnh 3',
                            'attributes' => [
                                'name'  => 'image_3',
                                'value' => null,
                            ],
                        ],
                        [
                            'type'       => 'mediaImage',
                            'label'      => 'Hình ảnh 4',
                            'attributes' => [
                                'name'  => 'image_4',
                                'value' => null,
                            ],
                        ],
                        [
                            'type'       => 'mediaImage',
                            'label'      => 'Hình ảnh 5',
                            'attributes' => [
                                'name'  => 'image_5',
                                'value' => null,
                            ],
                        ],
                        [
                            'type'       => 'mediaImage',
                            'label'      => 'Hình ảnh 6',
                            'attributes' => [
                                'name'  => 'image_6',
                                'value' => null,
                            ],
                        ],
                        [
                            'type'       => 'mediaImage',
                            'label'      => 'Hình ảnh 7',
                            'attributes' => [
                                'name'  => 'image_7',
                                'value' => null,
                            ],
                        ],
                        [
                            'type'       => 'mediaImage',
                            'label'      => 'Hình ảnh 8',
                            'attributes' => [
                                'name'  => 'image_8',
                                'value' => null,
                            ],
                        ],
                        [
                            'type'       => 'mediaImage',
                            'label'      => 'Hình ảnh 9',
                            'attributes' => [
                                'name'  => 'image_9',
                                'value' => null,
                            ],
                        ],
                        [
                            'type'       => 'mediaImage',
                            'label'      => 'Hình ảnh 10',
                            'attributes' => [
                                'name'  => 'image_10',
                                'value' => null,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ]);

    theme_option()->setSection([
        'title'      => 'Landing Page: Section 12',
        'priority'   => 21,
        'desc'       => 'Cấu hình nội dung cho Section 12 (Chia sẻ khách hàng)',
        'id'         => 'opt-text-subsection-landing-page-s12',
        'subsection' => true,
        'icon'       => 'fas fa-users',
        'fields'     => [
            [
                'id'         => 'ldp_s12_background',
                'type'       => 'mediaImage',
                'label'      => 'Ảnh nền (Background Image)',
                'attributes' => [
                    'name'    => 'ldp_s12_background',
                    'value'   => null,
                ],
            ],
            [
                'id'         => 'ldp_s12_heading',
                'type'       => 'text',
                'label'      => 'Tiêu đề (CHIA SẺ KHÁCH HÀNG)',
                'attributes' => [
                    'name'    => 'ldp_s12_heading',
                    'value'   => 'CHIA SẺ KHÁCH HÀNG',
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id'         => 'ldp_s12_testimonials',
                'type'       => 'repeater',
                'label'      => 'Danh sách Đánh giá',
                'attributes' => [
                    'name'   => 'ldp_s12_testimonials',
                    'value'  => null,
                    'fields' => [
                        [
                            'type'       => 'text',
                            'label'      => 'Tên khách hàng',
                            'attributes' => [
                                'name'    => 'name',
                                'value'   => null,
                                'options' => [
                                    'class' => 'form-control',
                                ],
                            ],
                        ],
                        [
                            'type'       => 'textarea',
                            'label'      => 'Nội dung chia sẻ',
                            'attributes' => [
                                'name'    => 'content',
                                'value'   => null,
                                'options' => [
                                    'class' => 'form-control',
                                    'rows'  => 4,
                                ],
                            ],
                        ],
                        [
                            'type'       => 'mediaImage',
                            'label'      => 'Ảnh đại diện (Avatar)',
                            'attributes' => [
                                'name'  => 'avatar',
                                'value' => null,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ]);

    theme_option()->setSection([
        'title'      => 'Landing Page: Section 13',
        'priority'   => 22,
        'desc'       => 'Cấu hình ảnh nền nguyên khối cho Section 13',
        'id'         => 'opt-text-subsection-landing-page-s13',
        'subsection' => true,
        'icon'       => 'fas fa-image',
        'fields'     => [
            [
                'id'         => 'ldp_s13_bg',
                'type'       => 'mediaImage',
                'label'      => 'Ảnh nền toàn bộ Section 13 (Có sẵn thiết kế form)',
                'attributes' => [
                    'name'    => 'ldp_s13_bg',
                    'value'   => null,
                ],
            ],
        ],
    ]);

    theme_option()->setSection([
        'title'      => 'Landing Page: Footer',
        'desc'       => 'Cấu hình thông tin Footer của Landing Page',
        'id'         => 'opt-text-subsection-landing-page-footer',
        'subsection' => true,
        'icon'       => 'fas fa-shoe-prints',
        'fields'     => [
            [
                'id'         => 'ldp_footer_logo',
                'type'       => 'mediaImage',
                'label'      => 'Logo trắng dưới Footer',
                'attributes' => [
                    'name'    => 'ldp_footer_logo',
                    'value'   => null,
                ],
            ],
            [
                'id'         => 'ldp_footer_address',
                'type'       => 'text',
                'label'      => 'Địa chỉ',
                'attributes' => [
                    'name'    => 'ldp_footer_address',
                    'value'   => null,
                    'options' => [
                        'class'        => 'form-control',
                        'placeholder'  => 'Nhập địa chỉ dự án',
                        'data-counter' => 255,
                    ],
                ],
            ],
            [
                'id'         => 'ldp_footer_email',
                'type'       => 'text',
                'label'      => 'Email',
                'attributes' => [
                    'name'    => 'ldp_footer_email',
                    'value'   => null,
                    'options' => [
                        'class'        => 'form-control',
                        'placeholder'  => 'Nhập email liên hệ',
                        'data-counter' => 120,
                    ],
                ],
            ],
            [
                'id'         => 'ldp_footer_phone',
                'type'       => 'text',
                'label'      => 'Số điện thoại',
                'attributes' => [
                    'name'    => 'ldp_footer_phone',
                    'value'   => null,
                    'options' => [
                        'class'        => 'form-control',
                        'placeholder'  => 'Nhập số điện thoại hotline',
                        'data-counter' => 120,
                    ],
                ],
            ],
            [
                'id'         => 'ldp_footer_facebook',
                'type'       => 'text',
                'label'      => 'Link Facebook',
                'attributes' => [
                    'name'    => 'ldp_footer_facebook',
                    'value'   => null,
                    'options' => [
                        'class'        => 'form-control',
                        'placeholder'  => 'Nhập link fanpage facebook',
                        'data-counter' => 255,
                    ],
                ],
            ],
            [
                'id'         => 'ldp_footer_youtube',
                'type'       => 'text',
                'label'      => 'Link Youtube',
                'attributes' => [
                    'name'    => 'ldp_footer_youtube',
                    'value'   => null,
                    'options' => [
                        'class'        => 'form-control',
                        'placeholder'  => 'Nhập link kênh youtube',
                        'data-counter' => 255,
                    ],
                ],
            ],
        ],
    ]);
