<?php

declare(strict_types = 1);

namespace Drupal\ucb_bootstrap_layouts\Plugin\Layout;

use Drupal\ucb_bootstrap_layouts\ucb_bootstrap_layouts;

/**
 * Provides a plugin class for two column layouts.
 */
final class TwoColumnLayout extends LayoutBase {

  /**
   * {@inheritdoc}
   */
  protected function getColumnWidths(): array {
    return [
      ucb_bootstrap_layouts::ROW_WIDTH_25_75 => $this->t('25% / 75%'),
      ucb_bootstrap_layouts::ROW_WIDTH_50_50 => $this->t('50% / 50%'),
      ucb_bootstrap_layouts::ROW_WIDTH_75_25 => $this->t('75% / 25%'),
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function getDefaultColumnWidth(): string {
    return ucb_bootstrap_layouts::ROW_WIDTH_50_50;
  }

}
