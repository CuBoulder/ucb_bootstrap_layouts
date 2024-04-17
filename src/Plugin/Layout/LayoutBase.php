<?php

declare(strict_types=1);

namespace Drupal\ucb_bootstrap_layouts\Plugin\Layout;

use Drupal\ucb_bootstrap_layouts\UCBLayout;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Layout\LayoutDefault;
use Drupal\media\Entity\Media;
use Drupal\file\Entity\File;



/**
 * Provides a layout base for custom layouts.
 */
abstract class LayoutBase extends LayoutDefault
{

  /**
   * {@inheritdoc}
   */
  public function build(array $regions): array
  {
    $build = parent::build($regions);

    $columnWidth = $this->configuration['column_width'];
    if ($columnWidth) {
      $build['#attributes']['class'][] = 'ucb-bootstrap-layout__row-width--' . $columnWidth;
    }

    /*
    $columnPaddingTop = $this->configuration['column_padding_top'];
    if ($columnPaddingTop !== 0) {
      $build['#attributes']['class'][] = 'ucb-bootstrap-layout__row-padding-top--' . $columnPaddingTop;
    }

    $columnPaddingBottom = $this->configuration['column_padding_bottom'];
    if ($columnPaddingBottom !== 0) {
      $build['#attributes']['class'][] = 'ucb-bootstrap-layout__row-padding-bottom--' . $columnPaddingBottom;
    }
    */

    $class = $this->configuration['class'];
    if ($class) {
      $build['#attributes']['class'] = array_merge(
        explode(' ', $this->configuration['class']),
        $build['#attributes']['class']
      );
    }

    return $build;
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration(): array
  {
    return [
      'background_color' => UCBLayout::ROW_BACKGROUND_COLOR_NONE,
      'content_frame_color' => UCBLayout::ROW_CONTENT_FRAME_COLOR_NONE,
      'background_image' == NULL,
      'background_image_styles' == NULL,
      'overlay_color' => UCBLayout::ROW_OVERLAY_COLOR_NONE,
      'background_effect' => UCBLayout::ROW_BACKGROUND_EFFECT_SCROLL,
      'class' => NULL,
      'column_width' => $this->getDefaultColumnWidth(),
      'section_padding_top' => "0px",
      'section_padding_right' => "0px",
      'section_padding_bottom' => "0px",
      'section_padding_left' => "0px",
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state): array
  {

    $backgroundColorOptions = $this->getBackgroundColorOptions();
    $contentFrameColorOptions = $this->getContentFrameColorOptions();
    $overlayColorOptions = $this->getOverlayColorOptions();
    $backgroundEffectOptions = $this->getBackgroundEffectOptions();
    $columnWidths = $this->getColumnWidths();
    /*
    $paddingTopOptions = $this->getPaddingTopOptions();
    $paddingBottomOptions = $this->getPaddingBottomOptions();
    */

    if ($this->configuration['column_width'] != '13') {

      $form['background'] = [
        '#type' => 'details',
        '#title' => $this->t('Background'),
        '#open' => FALSE,
        '#weight' => 30,
      ];

      $form['background']['background_color'] = [
        '#type' => 'radios',
        '#title' => $this->t('Background Color'),
        '#options' => $backgroundColorOptions,
        '#default_value' => $this->configuration['background_color'],
      ];

      $form['background']['background_image'] = [
        '#type' => 'media_library',
        '#allowed_bundles' => ['image'],
        '#title' => $this->t('Background Image'),
        '#default_value' => $this->configuration['background_image'] ?? NULL,
        '#description' => $this->t('Upload or select a background image.'),
      ];

      $form['background']['overlay_color'] = [
        '#type' => 'radios',
        '#title' => $this->t('Image Overlay Color'),
        '#options' => $overlayColorOptions,
        '#default_value' => $this->configuration['overlay_color'],
        '#description' => $this->t('Only applied if a background image is chosen.'),
      ];

      $form['background']['background_effect'] = [
        '#type' => 'radios',
        '#title' => $this->t('Background Effect'),
        '#options' => $backgroundEffectOptions,
        '#default_value' => $this->configuration['background_effect'],
        '#description' => $this->t('Choose an effect for the background image.'),
      ];

      $form['background']['content_frame_color'] = [
        '#type' => 'radios',
        '#title' => $this->t('Content Frame Color'),
        '#options' => $contentFrameColorOptions,
        '#default_value' => $this->configuration['content_frame_color'],
        '#description' => $this->t('Choose a color for the inner frame of the content.'),
      ];

      if (!empty($columnWidths)) {
        $form['layout'] = [
          '#type' => 'details',
          '#title' => $this->t('Layout'),
          '#open' => TRUE,
          '#weight' => 20,
        ];

        $form['layout']['column_width'] = [
          '#type' => 'radios',
          '#title' => $this->t('Column Width'),
          '#options' => $columnWidths,
          '#default_value' => $this->configuration['column_width'],
          '#required' => TRUE,
        ];
      }

      $form['spacing'] = [
        '#type' => 'details',
        '#title' => $this->t('Spacing'),
        '#open' => FALSE,
        '#weight' => 40,
      ];


      $form['spacing']['section_padding_top'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Top Section Padding'),
        '#default_value' => $this->configuration['section_padding_top'],
        '#required' => TRUE,
        '#description' => $this->t('Padding required with either px or %.'),
        '#element_validate' => [
          [$this, 'paddingFormatValidation'],
        ],
      ];

      $form['spacing']['section_padding_right'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Right Section Padding'),
        '#default_value' => $this->configuration['section_padding_right'],
        '#required' => TRUE,
        '#description' => $this->t('Padding required with either px or %.'),
        '#element_validate' => [
          [$this, 'paddingFormatValidation'],
        ],
      ];

      $form['spacing']['section_padding_bottom'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Bottom Section Padding'),
        '#default_value' => $this->configuration['section_padding_bottom'],
        '#required' => TRUE,
        '#description' => $this->t('Padding required with either px or %.'),
        '#element_validate' => [
          [$this, 'paddingFormatValidation'],
        ],
      ];

      $form['spacing']['section_padding_left'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Left Section Padding'),
        '#default_value' => $this->configuration['section_padding_left'],
        '#required' => false,
        '#description' => $this->t('Padding required with either px or %.'),
        '#element_validate' => [
          [$this, 'paddingFormatValidation'],
        ],
      ];

    }

    $form['#attached']['library'][] = 'ucb_bootstrap_layouts/layout_builder';

    return $form;
  }

  public function paddingFormatValidation($element, FormStateInterface $form_state)
  {
    $submitted_value = $element['#value'];
    $regex = "/^\d*+(?:px|%)$/";
    if (!preg_match($regex, $submitted_value)) {
      $form_state->setError($element, t('<p style="color: red;">Requires a number that ends with px or %</p>'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function validateConfigurationForm(array &$form, FormStateInterface $form_state)
  {
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state)
  {

    if ($this->configuration['column_width'] != '13') {
      $values = $form_state->getValues();
      $media = $values['background']['background_image'] ?? NULL;
      $overlay_selection = $values['background']['overlay_color'];
      $overlay_styles = "";
      $new_styles = "";
      $top_padding = $values['spacing']['section_padding_top'];
      $right_padding = $values['spacing']['section_padding_right'];
      $bottom_padding = $values['spacing']['section_padding_bottom'];
      $left_padding = $values['spacing']['section_padding_left'];

      if ($overlay_selection == "black") {
        $overlay_styles = "linear-gradient(rgb(20, 20, 20, 0.5), rgb(20, 20, 20, 0.5))";
      } elseif ($overlay_selection == "white") {
        $overlay_styles = "linear-gradient(rgb(255, 255, 255, 0.7), rgb(255, 255, 255, 0.7))";
      } else {
        $overlay_styles = "none";
      }


      if ($media) {
        $media_entity = Media::load($media);
        if ($media_entity) {
          $fid = $media_entity->getSource()->getSourceFieldValue($media_entity);
          $file = File::load($fid);
          $url = $file->createFileUrl();
          $media_image_styles = [
            'background:  ' . $overlay_styles . ', url(' . $url . ');',
            'background-position: center;',
            'background-size: cover;',
            'background-repeat: no-repeat;',
            'padding:' . $top_padding . ' ' . $right_padding . ' ' . $bottom_padding . ' ' . $left_padding,
          ];

          $new_styles = implode(' ', $media_image_styles);

        }
      } else {
        $media_image_styles = [
          'padding:' . $top_padding . ' ' . $right_padding . ' ' . $bottom_padding . ' ' . $left_padding,
        ];

        $new_styles = implode(' ', $media_image_styles);
      }

      $this->configuration['background_color'] = $values['background']['background_color'];
      /*$this->configuration['class'] = $values['extra']['class'];*/
      $this->configuration['background_image'] = $values['background']['background_image'] ?? NULL;
      $this->configuration['column_width'] = $values['layout']['column_width'];
      $this->configuration['background_image_styles'] = $new_styles;
      $this->configuration['overlay_color'] = $values['background']['overlay_color'];
      $this->configuration['background_effect'] = $values['background']['background_effect'];
      $this->configuration['content_frame_color'] = $values['background']['content_frame_color'];
      $this->configuration['section_padding_top'] = $values['spacing']['section_padding_top'];
      $this->configuration['section_padding_right'] = $values['spacing']['section_padding_right'];
      $this->configuration['section_padding_bottom'] = $values['spacing']['section_padding_bottom'];
      $this->configuration['section_padding_left'] = $values['spacing']['section_padding_left'];
    }

  }

  /**
   * Get the top padding options.
   *
   * @return array
   *   The top padding options.
   */
  /*protected function getPaddingTopOptions(): array {
    return [
      UCBLayout::ROW_TOP_PADDING_NONE => $this->t('None'),
      UCBLayout::ROW_TOP_PADDING_40 => $this->t('40px'),
      UCBLayout::ROW_TOP_PADDING_80 => $this->t('80px'),
    ];
  }
  */

  /**
   * Get the bottom padding options.
   *
   * @return array
   *   The bottom padding options.
   */
  /*protected function getPaddingBottomOptions(): array {
    return [
      UCBLayout::ROW_BOTTOM_PADDING_NONE => $this->t('None'),
      UCBLayout::ROW_BOTTOM_PADDING_40 => $this->t('40px'),
      UCBLayout::ROW_BOTTOM_PADDING_80 => $this->t('80px'),
    ];
  }
  /*

  /**
   * Get the background color options.
   *
   * @return array
   *   The background color options.
   */
  protected function getBackgroundColorOptions(): array
  {
    return [
      UCBLayout::ROW_BACKGROUND_COLOR_NONE => $this->t('None'),
      UCBLayout::ROW_BACKGROUND_COLOR_LIGHT_GRAY => $this->t('Light Gray'),
      UCBLayout::ROW_BACKGROUND_COLOR_DARK_GRAY => $this->t('Dark Gray'),
      UCBLayout::ROW_BACKGROUND_COLOR_BLACK => $this->t('Black'),
      UCBLayout::ROW_BACKGROUND_COLOR_GOLD => $this->t('Gold'),
      UCBLayout::ROW_BACKGROUND_COLOR_TAN => $this->t('Tan'),
      UCBLayout::ROW_BACKGROUND_COLOR_LIGHT_BLUE => $this->t('Light Blue'),
      UCBLayout::ROW_BACKGROUND_COLOR_MEDIUM_BLUE => $this->t('Medium Blue'),
      UCBLayout::ROW_BACKGROUND_COLOR_DARK_BLUE => $this->t('Dark Blue'),
      UCBLayout::ROW_BACKGROUND_COLOR_LIGHT_GREEN => $this->t('Light Green'),
      UCBLayout::ROW_BACKGROUND_COLOR_BRICK => $this->t('Brick'),
    ];
  }

  /**
   * Get the content frame color options.
   *
   * @return array
   *   The content frame color options.
   */
  protected function getContentFrameColorOptions(): array
  {
    return [
      UCBLayout::ROW_CONTENT_FRAME_COLOR_NONE => $this->t('None'),
      UCBLayout::ROW_CONTENT_FRAME_COLOR_LIGHT_GRAY => $this->t('Light Gray'),
      UCBLayout::ROW_CONTENT_FRAME_COLOR_DARK_GRAY => $this->t('Dark Gray')
    ];
  }



  /**
   * Get the background color options.
   *
   * @return array
   *   The background color options.
   */
  protected function getOverlayColorOptions(): array
  {
    return [
      UCBLayout::ROW_OVERLAY_COLOR_NONE => $this->t('None'),
      UCBLayout::ROW_OVERLAY_COLOR_BLACK => $this->t('Dark'),
      UCBLayout::ROW_OVERLAY_COLOR_WHITE => $this->t('Light'),
    ];
  }

  /**
   * Get the background effect options.
   *
   * @return array
   *   The background effect options.
   */
  protected function getBackgroundEffectOptions(): array
  {
    return [
      UCBLayout::ROW_BACKGROUND_EFFECT_SCROLL => $this->t('Fixed'),
      UCBLayout::ROW_BACKGROUND_EFFECT_FIXED => $this->t('Scroll'),
      UCBLayout::ROW_BACKGROUND_EFFECT_PARALLAX => $this->t('Parallax'),
    ];
  }

  /**
   * Get the column widths.
   *
   * @return array
   *   The column widths.
   */
  abstract protected function getColumnWidths(): array;

  /**
   * Get the default column width.
   *
   * @return string
   *   The default column width.
   */
  abstract protected function getDefaultColumnWidth(): string;


  /**
   * Determine if this layout has background settings.
   *
   * @return bool
   *   If this layout has background settings.
   */
  protected function hasBackgroundSettings(): bool
  {
    if (!empty($this->configuration['background_color'])) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  /**
   * Determine if this layout has extra settings.
   *
   * @return bool
   *   If this layout has extra settings.
   */
  /*
  protected function hasExtraSettings(): bool {
    return $this->configuration['class'] || $this->configuration['hero'];
  }
  */

}
