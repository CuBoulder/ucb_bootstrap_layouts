# CU Boulder Bootstrap Layouts

All notable changes to this project will be documented in this file.

Repo : [GitHub Repository](https://github.com/CuBoulder/ucb_bootstrap_layouts)

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

- ### Fixed Frame and Overlay
  Fixed framing for single column rows (the frame wasn't showing on single column rows) 
  - test this by adding a content frame
  
  Added a new default for overlay classes. (caused css issues)
  - This one is harder to actually see the results of because nothing should happen when you select overlays without images
  
  Closes #21 
---

- ### Update LayoutBase.php
  Added an else statement to apply padding to section even when background images aren't used
  
  Closes #17 
---

- ### Issue/471
  Updated edge-to-edge option for single column layouts
  Makes hero units, video reveals, and sliders work as full width sections.
  
  Sister PR: https://github.com/CuBoulder/tiamat-theme/pull/474
---

- ### Fix Frames
  Fixed the frames so that the bootstrap columns work properly
  
  Closes #14 
---

- ### Content Frame Update
  Added option for frame color to the background options of layout builder when creating or editing a Section.
  
  Choosing the light option keeps text black.
  Choosing the dark option sets the text to white.
  We will probably need to edit some css for certain blocks but we'll take that case by case.
  
  Closes #12 
---

- ### Adds `CHANGELOG.MD` and workflows; updates `core_version_requirement` to indicate D10 compatibility
  Additionally uses "CU Boulder" package and adds additional supporting files to match our other custom modules. Resolves CuBoulder/ucb_bootstrap_layouts#10
---
