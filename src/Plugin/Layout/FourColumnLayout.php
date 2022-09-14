<?php

declare(strict_types = 1);

namespace Drupal\ucb_bootstrap_layouts\Plugin\Layout;

use Drupal\ucb_bootstrap_layouts\UCBLayout;

/**
 * Provides a plugin class for four column layouts.
 */
final class FourColumnLayout extends LayoutBase {

  /**
   * {@inheritdoc}
   */
  protected function getColumnWidths(): array {
    return [
      UCBLayout::ROW_WIDTH_25_25_25_25 => $this->t('25% / 25% / 25% / 25%'),
    ];
  } 

  /**
   * {@inheritdoc}
   */
  protected function getDefaultColumnWidth(): string {
    return UCBLayout::ROW_WIDTH_25_25_25_25;
  }

}
