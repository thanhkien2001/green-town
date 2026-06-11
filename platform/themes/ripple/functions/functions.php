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
    ]);
    
    // Section 2
    // ->setSection([
    //     'title'      => 'Landing Page: S2 Video',
    //     'desc'       => 'Cấu hình Section 2 (Video Teaser)',
    //     'priority'   => 11,
    //     'id'         => 'opt-section-landing-s2',
    //     'subsection' => true,
    //     'icon'       => 'fa fa-play-circle',
    //     'fields'     => [
    //         [
    //             'id'         => 'ldp_s2_video_url',
    //             'type'       => 'text',
    //             'label'      => 'Video URL (MP4, YouTube, Vimeo, etc)',
    //             'attributes' => [
    //                 'name'    => 'ldp_s2_video_url',
    //                 'value'   => null,
    //                 'options' => [
    //                     'class'       => 'form-control',
    //                     'placeholder' => '/storage/video.mp4',
    //                 ],
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s2_video_poster',
    //             'type'       => 'mediaImage',
    //             'label'      => 'Ảnh Thumbnail (Preview cho Video)',
    //             'attributes' => [
    //                 'name'  => 'ldp_s2_video_poster',
    //                 'value' => null,
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s2_title',
    //             'type'       => 'text',
    //             'label'      => 'Tiêu đề Overlay',
    //             'attributes' => [
    //                 'name'    => 'ldp_s2_title',
    //                 'value'   => null,
    //                 'options' => [
    //                     'class'       => 'form-control',
    //                     'placeholder' => 'ĐIỀU ĐẶC BIỆT',
    //                 ],
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s2_subtitle',
    //             'type'       => 'text',
    //             'label'      => 'Phụ đề Overlay',
    //             'attributes' => [
    //                 'name'    => 'ldp_s2_subtitle',
    //                 'value'   => null,
    //                 'options' => [
    //                     'class'       => 'form-control',
    //                     'placeholder' => 'ĐÃ LỘ DIỆN',
    //                 ],
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s2_bg',
    //             'type'       => 'mediaImage',
    //             'label'      => 'Background Desktop (Section 2)',
    //             'attributes' => [
    //                 'name'  => 'ldp_s2_bg',
    //                 'value' => null,
    //             ],
    //         ],
    //         [
    //             'id'         => 'ldp_s2_bg_mb',
    //             'type'       => 'mediaImage',
    //             'label'      => 'Background Mobile (Section 2)',
    //             'attributes' => [
    //                 'name'  => 'ldp_s2_bg_mb',
    //                 'value' => null,
    //             ],
    //         ],
    //     ],
    // ])

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

    theme_option()->setSection([
        'title'      => 'Landing Page: Section 11',
        'desc'       => 'Cấu hình nội dung cho Section 11 (Slider Hình Ảnh)',
        'id'         => 'opt-text-subsection-landing-page-s11',
        'subsection' => true,
        'icon'       => 'fas fa-images',
        'fields'     => [
            [
                'id'         => 'ldp_s11_heading',
                'type'       => 'text',
                'label'      => 'Tiêu đề thanh ngang (CHIẾT KHẤU 5%)',
                'attributes' => [
                    'name'    => 'ldp_s11_heading',
                    'value'   => 'CHIẾT KHẤU 5%',
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
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
        'desc'       => 'Cấu hình nội dung cho Section 12 (Chia sẻ khách hàng)',
        'id'         => 'opt-text-subsection-landing-page-s12',
        'subsection' => true,
        'icon'       => 'fas fa-users',
        'fields'     => [
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