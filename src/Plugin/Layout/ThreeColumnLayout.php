<?php

declare(strict_types = 1);

namespace Drupal\ucb_bootstrap_layouts\Plugin\Layout;

use Drupal\ucb_bootstrap_layouts\UCBLayout;

/**
 * Provides a plugin class for three column layouts.
 */
final class ThreeColumnLayout extends LayoutBase {

  /**
   * {@inheritdoc}
   */
  protected function getColumnWidths(): array {
    return [
      UCBLayout::ROW_WIDTH_25_25_50 => $this->t('25% / 25% / 50%'),
      UCBLayout::ROW_WIDTH_33_33_33 => $this->t('33% / 34% / 33%'),
      UCBLayout::ROW_WIDTH_25_50_25 => $this->t('25% / 50% / 25%'),
      UCBLayout::ROW_WIDTH_50_25_25 => $this->t('50% / 25% / 25%'),
    ];
  } 

  /**
   * {@inheritdoc}
   */
  protected function getDefaultColumnWidth(): string {
    return UCBLayout::ROW_WIDTH_33_33_33;
  }

}
