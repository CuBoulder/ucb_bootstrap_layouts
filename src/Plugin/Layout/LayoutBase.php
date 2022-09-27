<?php

declare(strict_types = 1);

namespace Drupal\ucb_bootstrap_layouts\Plugin\Layout;

use Drupal\ucb_bootstrap_layouts\UCBLayout;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Layout\LayoutDefault;

/**
 * Provides a layout base for custom layouts.
 */
abstract class LayoutBase extends LayoutDefault {

  /**
   * {@inheritdoc}
   */
  public function build(array $regions): array {
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
  public function defaultConfiguration(): array {
    return [
      'background_color' => UCBLayout::ROW_BACKGROUND_COLOR_NONE,
      'container_width' => UCBLayout::ROW_CONTAINER_WIDTH_REGULAR,
      'class' => NULL,
      'column_width' => $this->getDefaultColumnWidth(),
      /*'column_padding_top' => UCBLayout::ROW_TOP_PADDING_NONE,
      'column_padding_bottom' => UCBLayout::ROW_BOTTOM_PADDING_NONE,*/
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state): array {

    $backgroundColorOptions = $this->getBackgroundColorOptions();
    $columnWidths = $this->getColumnWidths();
    $containerWidths = $this->getContainerWidths();
    /*
    $paddingTopOptions = $this->getPaddingTopOptions();
    $paddingBottomOptions = $this->getPaddingBottomOptions();
    */

    $form['background'] = [
      '#type' => 'details',
      '#title' => $this->t('Background'),
      '#open' => $this->hasBackgroundSettings(),
      '#weight' => 20,
    ];

    $form['background']['background_color'] = [
      '#type' => 'radios',
      '#title' => $this->t('Background Color'),
      '#options' => $backgroundColorOptions,
      '#default_value' => $this->configuration['background_color'],
    ];

    if (!empty($columnWidths)) {
      $form['layout'] = [
        '#type' => 'details',
        '#title' => $this->t('Layout'),
        '#open' => TRUE,
        '#weight' => 30,
      ];

      $form['layout']['column_width'] = [
        '#type' => 'radios',
        '#title' => $this->t('Column Width'),
        '#options' => $columnWidths,
        '#default_value' => $this->configuration['column_width'],
        '#required' => TRUE,
      ];

      $form['layout']['container_width'] = [
        '#type' => 'radios',
        '#title' => $this->t('Content Width'),
        '#options' => $containerWidths,
        '#default_value' => $this->configuration['container_width'],
        '#required' => TRUE,
      ];

      /*
      $form['layout']['column_padding_top'] = [
        '#type' => 'radios',
        '#title' => $this->t('Column Padding Top'),
        '#options' => $paddingTopOptions,
        '#default_value' => $this->configuration['column_padding_top'],
        '#required' => TRUE,
      ];

      $form['layout']['column_padding_bottom'] = [
        '#type' => 'radios',
        '#title' => $this->t('Column Padding Bottom'),
        '#options' => $paddingBottomOptions,
        '#default_value' => $this->configuration['column_padding_bottom'],
        '#required' => TRUE,
      ];
      */
    }

    /*
    $form['extra'] = [
      '#type' => 'details',
      '#title' => $this->t('Extra'),
      '#open' => $this->hasExtraSettings(),
      '#weight' => 40,
    ];

    $form['extra']['class'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Custom Class'),
      '#description' => $this->t('Enter custom css classes for this row. Separate multiple classes by a space and do not include a period.'),
      '#default_value' => $this->configuration['class'],
      '#attributes' => [
        'placeholder' => 'class-one class-two',
      ],
    ];
    */

    $form['#attached']['library'][] = 'ucb_bootstrap_layouts/layout_builder';

    return $form;
  }


  /**
   * {@inheritdoc}
   */
  public function validateConfigurationForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();

    $this->configuration['background_color'] = $values['background']['background_color'];
    /*$this->configuration['class'] = $values['extra']['class'];*/
    $this->configuration['column_width'] = $values['layout']['column_width'];
    $this->configuration['container_width'] = $values['layout']['container_width'];
   /*$this->configuration['column_padding_top'] = $values['layout']['column_padding_top'];
    $this->configuration['column_padding_bottom'] = $values['layout']['column_padding_bottom'];*/
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
  protected function getBackgroundColorOptions(): array {
    return [
      UCBLayout::ROW_BACKGROUND_COLOR_NONE => $this->t('None'),
      UCBLayout::ROW_BACKGROUND_COLOR_LIGHT_GRAY => $this->t('Light Gray'),
      UCBLayout::ROW_BACKGROUND_COLOR_DARK_GRAY => $this->t('Dark Gray'),
      UCBLayout::ROW_BACKGROUND_COLOR_BLACK => $this->t('Black'),
      UCBLayout::ROW_BACKGROUND_COLOR_GOLD => $this->t('Gold'),
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
   * Get container width. 
   *  
   * @return array
   *     The container width.
   * 
   **/
  protected function getContainerWidths(): array {
    return [
      UCBLayout::ROW_CONTAINER_WIDTH_REGULAR => $this->t('Contained'),
      UCBLayout::ROW_CONTAINER_WIDTH_FLUID => $this->t('Edge-to-edge'),
    ];
  }

  /**
   * Determine if this layout has background settings.
   *
   * @return bool
   *   If this layout has background settings.
   */
  protected function hasBackgroundSettings(): bool {
    if (!empty($this->configuration['background_color'])) {
      return TRUE;
    }
    else {
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
