<?php

declare(strict_types = 1);

namespace Drupal\ucb_bootstrap_layouts\Plugin\Layout;

use Drupal\ucb_bootstrap_layouts\UCBLayout;

/**
 * Provides a plugin class for two column layouts.
 */
final class TwoColumnLayout extends LayoutBase {

  /**
   * {@inheritdoc}
   */
  protected function getColumnWidths(): array {
    return [
      UCBLayout::ROW_WIDTH_25_75 => $this->t('25% / 75%'),
      UCBLayout::ROW_WIDTH_50_50 => $this->t('50% / 50%'),
      UCBLayout::ROW_WIDTH_75_25 => $this->t('75% / 25%'),
    ];
  } 

  /**
   * {@inheritdoc}
   */
  protected function getDefaultColumnWidth(): string {
    return UCBLayout::ROW_WIDTH_50_50;
  }

}
