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
    ]);

    // // Section 3
    // ->setSection([
    //     'title'      => 'Landing Page: S3 Highlights',
    //     'desc'       => 'Cấu hình Section 3',
    //     'priority'   => 12,
    //     'id'         => 'opt-section-landing-s3',
    //     'subsection' => true,
    //     'icon'       => 'fa fa-star',
    //     'fields'     => [
    //         [
    //             'id'         => 'ldp_s3_bg',
    //             'type'       => 'mediaImage',
    //             'label'      => 'Background Desktop (Section 3)',
    //             'attributes' => [
    //                 'name'  => 'ldp_s3_bg',
    //                 'value' => null,
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s3_bg_mb',
    //             'type'       => 'mediaImage',
    //             'label'      => 'Background Mobile (Section 3)',
    //             'attributes' => [
    //                 'name'  => 'ldp_s3_bg_mb',
    //                 'value' => null,
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s3_f1_img',
    //             'type'       => 'mediaImage',
    //             'label'      => 'Feature 1: Hình ảnh',
    //             'attributes' => [
    //                 'name'  => 'ldp_s3_f1_img',
    //                 'value' => null,
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s3_f1_title',
    //             'type'       => 'text',
    //             'label'      => 'Feature 1: Tiêu đề',
    //             'attributes' => [
    //                 'name'    => 'ldp_s3_f1_title',
    //                 'value'   => null,
    //                 'options' => [
    //                     'class'       => 'form-control',
    //                     'placeholder' => 'Ngôn Ngữ nhận diện Star-map',
    //                 ],
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s3_f1_desc',
    //             'type'       => 'text',
    //             'label'      => 'Feature 1: Mô tả',
    //             'attributes' => [
    //                 'name'    => 'ldp_s3_f1_desc',
    //                 'value'   => null,
    //                 'options' => [
    //                     'class'       => 'form-control',
    //                     'placeholder' => 'DNA Thiết Kế SUV Kia',
    //                 ],
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s3_f2_img',
    //             'type'       => 'mediaImage',
    //             'label'      => 'Feature 2 (Center): Hình ảnh',
    //             'attributes' => [
    //                 'name'  => 'ldp_s3_f2_img',
    //                 'value' => null,
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s3_f2_title',
    //             'type'       => 'text',
    //             'label'      => 'Feature 2 (Center): Tiêu đề',
    //             'attributes' => [
    //                 'name'    => 'ldp_s3_f2_title',
    //                 'value'   => null,
    //                 'options' => [
    //                     'class'       => 'form-control',
    //                     'placeholder' => 'Không gian nội thất',
    //                 ],
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s3_f2_desc',
    //             'type'       => 'text',
    //             'label'      => 'Feature 2 (Center): Mô tả',
    //             'attributes' => [
    //                 'name'    => 'ldp_s3_f2_desc',
    //                 'value'   => null,
    //                 'options' => [
    //                     'class'       => 'form-control',
    //                     'placeholder' => 'đầy cảm hứng',
    //                 ],
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s3_f3_img',
    //             'type'       => 'mediaImage',
    //             'label'      => 'Feature 3: Hình ảnh',
    //             'attributes' => [
    //                 'name'  => 'ldp_s3_f3_img',
    //                 'value' => null,
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s3_f3_title',
    //             'type'       => 'text',
    //             'label'      => 'Feature 3: Tiêu đề',
    //             'attributes' => [
    //                 'name'    => 'ldp_s3_f3_title',
    //                 'value'   => null,
    //                 'options' => [
    //                     'class'       => 'form-control',
    //                     'placeholder' => 'Công nghệ Hybrid cao cấp',
    //                 ],
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s3_f3_desc',
    //             'type'       => 'text',
    //             'label'      => 'Feature 3: Mô tả',
    //             'attributes' => [
    //                 'name'    => 'ldp_s3_f3_desc',
    //                 'value'   => null,
    //                 'options' => [
    //                     'class'       => 'form-control',
    //                     'placeholder' => 'vận hành mạnh mẽ, êm ái',
    //                 ],
    //             ],
    //         ],
    //     ],
    // ])

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

    // // Section 5
    // ->setSection([
    //     'title'      => 'Landing Page: S5 Footer',
    //     'desc'       => 'Cấu hình Section 5 (Footer)',
    //     'priority'   => 14,
    //     'id'         => 'opt-section-landing-s5',
    //     'subsection' => true,
    //     'icon'       => 'fa fa-arrow-down',
    //     'fields'     => [
    //         [
    //             'id'         => 'ldp_s5_logo',
    //             'type'       => 'mediaImage',
    //             'label'      => 'Logo Footer (VD: KIA Movement that inspires)',
    //             'attributes' => [
    //                 'name'  => 'ldp_s5_logo',
    //                 'value' => null,
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s5_hotline',
    //             'type'       => 'text',
    //             'label'      => 'Hotline CSKH',
    //             'attributes' => [
    //                 'name'    => 'ldp_s5_hotline',
    //                 'value'   => null,
    //                 'options' => [
    //                     'class'       => 'form-control',
    //                     'placeholder' => '1900 545 591',
    //                 ],
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s5_fb_url',
    //             'type'       => 'url',
    //             'label'      => 'Link Facebook',
    //             'attributes' => [
    //                 'name'    => 'ldp_s5_fb_url',
    //                 'value'   => null,
    //                 'options' => [
    //                     'class'       => 'form-control',
    //                     'placeholder' => 'https://facebook.com/...',
    //                 ],
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s5_ig_url',
    //             'type'       => 'url',
    //             'label'      => 'Link Instagram',
    //             'attributes' => [
    //                 'name'    => 'ldp_s5_ig_url',
    //                 'value'   => null,
    //                 'options' => [
    //                     'class'       => 'form-control',
    //                     'placeholder' => 'https://instagram.com/...',
    //                 ],
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s5_yt_url',
    //             'type'       => 'url',
    //             'label'      => 'Link YouTube',
    //             'attributes' => [
    //                 'name'    => 'ldp_s5_yt_url',
    //                 'value'   => null,
    //                 'options' => [
    //                     'class'       => 'form-control',
    //                     'placeholder' => 'https://youtube.com/...',
    //                 ],
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s5_terms_text',
    //             'type'       => 'text',
    //             'label'      => 'Text Link Điều khoản',
    //             'attributes' => [
    //                 'name'    => 'ldp_s5_terms_text',
    //                 'value'   => null,
    //                 'options' => [
    //                     'class'       => 'form-control',
    //                     'placeholder' => 'Các điều khoản và điều kiện chung',
    //                 ],
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s5_terms_url',
    //             'type'       => 'url',
    //             'label'      => 'URL Điều khoản',
    //             'attributes' => [
    //                 'name'    => 'ldp_s5_terms_url',
    //                 'value'   => null,
    //                 'options' => [
    //                     'class'       => 'form-control',
    //                     'placeholder' => '#',
    //                 ],
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s5_privacy_text',
    //             'type'       => 'text',
    //             'label'      => 'Text Link Bảo mật',
    //             'attributes' => [
    //                 'name'    => 'ldp_s5_privacy_text',
    //                 'value'   => null,
    //                 'options' => [
    //                     'class'       => 'form-control',
    //                     'placeholder' => 'Chính sách bảo mật thông tin cá nhân',
    //                 ],
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s5_privacy_url',
    //             'type'       => 'url',
    //             'label'      => 'URL Bảo mật',
    //             'attributes' => [
    //                 'name'    => 'ldp_s5_privacy_url',
    //                 'value'   => null,
    //                 'options' => [
    //                     'class'       => 'form-control',
    //                     'placeholder' => '#',
    //                 ],
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s5_bg',
    //             'type'       => 'mediaImage',
    //             'label'      => 'Background Desktop (Section 5)',
    //             'attributes' => [
    //                 'name'  => 'ldp_s5_bg',
    //                 'value' => null,
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s5_bg_mb',
    //             'type'       => 'mediaImage',
    //             'label'      => 'Background Mobile (Section 5)',
    //             'attributes' => [
    //                 'name'  => 'ldp_s5_bg_mb',
    //                 'value' => null,
    //             ],
    //         ],
    //     ],
    // ]);

