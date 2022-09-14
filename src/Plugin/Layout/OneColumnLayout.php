<?php

declare(strict_types = 1);

namespace Drupal\ucb_bootstrap_layouts\Plugin\Layout;

use Drupal\ucb_bootstrap_layouts\UCBLayout;

/**
 * Provides a plugin class for a one column layout.
 */
final class OneColumnLayout extends LayoutBase {

  /**
   * {@inheritdoc}
   */
  protected function getColumnWidths(): array {
    return [
      UCBLayout::ROW_WIDTH_100 => $this->t('100%'),
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function getDefaultColumnWidth(): string {
    return UCBLayout::ROW_WIDTH_100;
  }

}
