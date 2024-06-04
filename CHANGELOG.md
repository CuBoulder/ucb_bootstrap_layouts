# CU Boulder Bootstrap Layouts

All notable changes to this project will be documented in this file.

Repo : [GitHub Repository](https://github.com/CuBoulder/ucb_bootstrap_layouts)

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

- ### Fixes some blocks having white background with white text in Layout Builder
  Resolves CuBoulder/ucb_bootstrap_layouts#45
---

- ### Fixed missing class
  Added missing contained row class to layouts
  
  Sister PR: https://github.com/CuBoulder/tiamat-theme/pull/1016
---

## [20240513] - 2024-05-13

-   ### Update layout--edge-to-edge.html.twig

    Added the missing `g-0` class needed for edge to edge with 0 horizontal scroll

    Sister PR: <https://github.com/CuBoulder/tiamat-theme/pull/951>

* * *

-   ### Update layout--two-column.html.twig

    Added trim fix for images and iframes.

    If there are other tags that you can think of that would be stripped out despite being real content let me know.

    Resolves #39 

* * *

-   ### Update layout--two-column.html.twig

    Sister PR: <https://github.com/CuBoulder/tiamat-theme/pull/898>
    Sister PR: <https://github.com/CuBoulder/tiamat10-profile/pull/119>
    Sister PR: <https://github.com/CuBoulder/tiamat-custom-entities/pull/135>

    Updated two column layout to be flex-grow-1 for each column and to check if the column is empty (mainly for the sake of empty menus) for rendering purposes.
    This is for the new default layout of the basic page.

* * *

-   ### Frame syntax fix
    Spaces needed to be added to these two rows because they were breaking the styles of the section.

* * *

-   ### Update ucb_bootstrap_layouts.module

    Hooks to remove contextual links everywhere but the layout builder pages.

    Sister PR: <https://github.com/CuBoulder/tiamat-theme/pull/870>

* * *

-   ### Light overlay update

    Modifies the Light Overlay on section background images to be more white than gray so particularly light background images are no longer darkened by the overlay due

    Resolves #32 

* * *

-   ### edge-to-edge update

    Set up `edge-to-edge` as a separate layout rather than a sub-option for `one column`

    It is technically a "13 column" row for the sake of UCBLayout and LayoutBase as to differentiate form options between it and the `one column`

    Edge-to-edge does not have the normal form options all the other layouts have but instead just receives defaults for said options. These defaults are passed into the template so everything is "filled out" properly.

    Icon on column choice is the same as `One Column` because those icons are made automatically through layout builder based on number of rows in the section.

    A test of creating a current single column row with edge-to-edge option, and then updating to the newest code would be good to see how this is going to affect our current sandboxes. 
    The site does not break but users will be unable to choose `edge-to-edge` as an option anymore in the `one column` sections. If someone edits a previous `edge-to-edge one column` the form will override to the default `100% contained width` thereby switching it away from `edge-to-edge`. This is a manual process and will not automatically switch after this update is rolled out.

    Order of section options:
    <img width="296" alt="Screenshot 2024-04-11 at 10 26 54 AM" src="https://github.com/CuBoulder/ucb_bootstrap_layouts/assets/94021017/03f5180a-1804-468c-944c-1af438ed9f4e">

    Closes #30 

* * *

-   ### Remove g-0

    Remove `g-0` for zero gutter. Taken care of through css now.

    Closes #27 

    Sister PR: <https://github.com/CuBoulder/tiamat-theme/pull/751>

* * *

-   ### Layout Builder Style and Feature Addition

    Fixed hero and event calendar classes showing in content 
    Fixed color layering and cascading
    Added `None` as an option for `Block Style` background color

    Related PR: <https://github.com/CuBoulder/tiamat-theme/pull/747>
    Related PR: <https://github.com/CuBoulder/tiamat-custom-entities/pull/109>

* * *

-   ### Update ucb-bootstrap-layouts.css

    Update for dialog box close button fix
    New admin theme changes

    Sister PRs:
    <https://github.com/CuBoulder/tiamat-theme/pull/639>
    <https://github.com/CuBoulder/tiamat10-project-template/pull/30>
    <https://github.com/CuBoulder/tiamat10-profile/pull/69>

* * *

## [20231212] - 2023-12-12

-   ### Fixed Frame and Overlay

    Fixed framing for single column rows (the frame wasn't showing on single column rows) 

    -   test this by adding a content frame

    Added a new default for overlay classes. (caused css issues)

    -   This one is harder to actually see the results of because nothing should happen when you select overlays without images

    Closes #21 

* * *

-   ### Update LayoutBase.php

    Added an else statement to apply padding to section even when background images aren't used

    Closes #17 

* * *

-   ### Issue/471

    Updated edge-to-edge option for single column layouts
    Makes hero units, video reveals, and sliders work as full width sections.

    Sister PR: <https://github.com/CuBoulder/tiamat-theme/pull/474>

* * *

-   ### Fix Frames

    Fixed the frames so that the bootstrap columns work properly

    Closes #14 

* * *

-   ### Content Frame Update

    Added option for frame color to the background options of layout builder when creating or editing a Section.

    Choosing the light option keeps text black.
    Choosing the dark option sets the text to white.
    We will probably need to edit some css for certain blocks but we'll take that case by case.

    Closes #12 

* * *

-   ### Adds `CHANGELOG.MD` and workflows; updates `core_version_requirement` to indicate D10 compatibility
    Additionally uses "CU Boulder" package and adds additional supporting files to match our other custom modules. Resolves CuBoulder/ucb_bootstrap_layouts#10

* * *

[Unreleased]: https://github.com/CuBoulder/ucb_bootstrap_layouts/compare/20240513...HEAD

[20240513]: https://github.com/CuBoulder/ucb_bootstrap_layouts/compare/20231212...20240513

[20231212]: https://github.com/CuBoulder/ucb_bootstrap_layouts/compare/93dacf324729313b5be20a77290a153a2cfad841...20231212
