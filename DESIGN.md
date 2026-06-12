---
name: Yadro Fizika Admin
description: Dense, official admin UI for scientific institute content management.
colors:
  primary-blue: "#3874ff"
  primary-blue-emphasis: "#003cc7"
  primary-blue-subtle: "#e5edff"
  success: "#25b003"
  success-subtle: "#d9fbd0"
  warning: "#e5780b"
  warning-subtle: "#ffefca"
  danger: "#fa3b1d"
  danger-subtle: "#ffe0db"
  info: "#0097eb"
  body-bg: "#f5f7fa"
  surface: "#ffffff"
  surface-muted: "#eff2f6"
  surface-line: "#e3e6ed"
  border: "#cbd0dd"
  border-translucent: "#cbd0dd8a"
  text: "#31374a"
  text-muted: "#6e7891"
  text-strong: "#141824"
typography:
  display:
    fontFamily: "Nunito Sans, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif"
    fontSize: "1.75rem"
    fontWeight: 700
    lineHeight: 1.2
  headline:
    fontFamily: "Nunito Sans, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif"
    fontSize: "1.5rem"
    fontWeight: 700
    lineHeight: 1.25
  title:
    fontFamily: "Nunito Sans, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif"
    fontSize: "1rem"
    fontWeight: 600
    lineHeight: 1.35
  body:
    fontFamily: "Nunito Sans, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif"
    fontSize: "1rem"
    fontWeight: 400
    lineHeight: 1.49
  label:
    fontFamily: "Nunito Sans, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif"
    fontSize: "0.75rem"
    fontWeight: 700
    lineHeight: 1.2
    letterSpacing: "0.08em"
rounded:
  sm: "0.25rem"
  md: "0.375rem"
  lg: "0.5rem"
  xl: "1rem"
  pill: "50rem"
spacing:
  xs: "0.25rem"
  sm: "0.5rem"
  md: "1rem"
  lg: "1.5rem"
  xl: "2rem"
components:
  button-primary:
    backgroundColor: "{colors.primary-blue}"
    textColor: "{colors.surface}"
    rounded: "{rounded.md}"
    padding: "0.5rem 1rem"
  button-secondary:
    backgroundColor: "{colors.surface}"
    textColor: "{colors.text}"
    rounded: "{rounded.md}"
    padding: "0.5rem 1rem"
  button-danger:
    backgroundColor: "{colors.danger}"
    textColor: "{colors.surface}"
    rounded: "{rounded.md}"
    padding: "0.5rem 1rem"
  input-default:
    backgroundColor: "{colors.surface}"
    textColor: "{colors.text}"
    rounded: "{rounded.md}"
    padding: "0.5rem 0.75rem"
  card-default:
    backgroundColor: "{colors.surface}"
    textColor: "{colors.text}"
    rounded: "{rounded.lg}"
    padding: "1rem"
  badge-primary:
    backgroundColor: "{colors.primary-blue-subtle}"
    textColor: "{colors.primary-blue-emphasis}"
    rounded: "{rounded.pill}"
    padding: "0.35rem 0.75rem"
---

# Design System: Yadro Fizika Admin

## 1. Overview

**Creative North Star: "The Institutional Control Room"**

This design system serves a dense scientific institute admin panel. It should feel like a control room for verified content: official, structured, and fast to scan. The user is usually editing, approving, searching, or checking status, so the interface must make hierarchy and next actions obvious without decorative noise.

The system is layered rather than flat: panels, cards, dropdowns, modals, and hover states can use elevation, but only to clarify state or grouping. It explicitly rejects the PRODUCT.md anti-references: decorative SaaS landing page styling, gradient-heavy decoration, glassmorphism, noisy color-card grids, and inconsistent form/button vocabularies.

**Key Characteristics:**
- Dense admin surfaces with clear section boundaries.
- Restrained blue accent used for actions, links, active nav, and selected states.
- Official neutral canvas with white content surfaces and slate text.
- Layered elevation for task hierarchy, not visual drama.
- Uzbek/Russian/English content must fit without breaking tables, tabs, or forms.

## 2. Colors

The palette is a restrained Phoenix-admin palette: one institutional blue accent, semantic status colors, and cool slate neutrals.

### Primary
- **Institutional Action Blue**: Primary actions, links, active navigation, focus accents, selected badges, and current state markers.
- **Action Blue Emphasis**: High-contrast text on subtle blue backgrounds and active state emphasis.
- **Action Blue Wash**: Subtle background for selected badges, callouts, and low-intensity primary state.

### Secondary
- **Operational Green**: Success, active records, completed states, and positive status badges.
- **Audit Amber**: Warning, attention-required states, and non-blocking review cues.
- **Critical Red**: Destructive actions, errors, and failed validation.
- **System Info Blue**: Informational helper states distinct from primary action emphasis.

### Neutral
- **Workspace Background**: The app canvas behind sidebars, dashboards, and forms.
- **Surface White**: Cards, forms, dropdowns, modals, table bodies, and main content panels.
- **Muted Surface**: Toolbar strips, secondary panels, disabled-looking backgrounds, and soft separators.
- **Line Grey**: Dividers, table borders, input borders, and quiet card outlines.
- **Control Text**: Default body text and table content.
- **Muted Text**: Helper copy, secondary labels, breadcrumbs, and metadata.
- **Strong Ink**: Page titles, card headings, and important labels.

### Named Rules

**The One Accent Rule.** Institutional Action Blue is the only primary accent. Do not add new saturated accent families unless the state is semantic: success, warning, danger, or info.

**The Subtle State Rule.** Badge and alert backgrounds use subtle tints; inactive states never use full-saturation colors.

## 3. Typography

**Display Font:** Nunito Sans with system sans fallbacks.
**Body Font:** Nunito Sans with system sans fallbacks.
**Label/Mono Font:** SFMono-Regular stack only for code-like technical values when needed.

**Character:** One sans family carries the whole product UI. The type should be familiar, compact, and readable in data-heavy CRUD screens; no display fonts in labels, buttons, tables, or admin controls.

### Hierarchy
- **Display** (700, 1.75rem, 1.2): Dashboard-level page titles and high-level admin screen headings.
- **Headline** (700, 1.5rem, 1.25): Section headers and important form/detail page titles.
- **Title** (600, 1rem, 1.35): Card headings, table block headings, tab titles, and form group labels.
- **Body** (400, 1rem, 1.49): Default content, descriptions, table cells, form helper text, and admin copy.
- **Label** (700, 0.75rem, 0.08em): Compact uppercase button labels in Breeze-style components only; do not apply uppercase tracking to every section heading.

### Named Rules

**The Product Type Rule.** Use fixed rem sizes, not fluid clamp scales. Admin users need stable density more than responsive headline drama.

**The No Display Labels Rule.** Labels, buttons, table cells, and nav items must stay in the product sans vocabulary.

## 4. Elevation

The system is layered. Default surfaces use borders and tonal separation; interactive or floating surfaces may use shadows. Hover elevation is allowed for dashboard cards and actionable cards, while modals and dropdowns use stronger elevation to escape the page layer.

### Shadow Vocabulary
- **Surface Rest** (`0px 2px 4px -2px rgba(36, 40, 46, 0.08)`): Quiet Phoenix surface shadow when a card needs separation from the workspace.
- **Control Low** (`0 0.125rem 0.25rem rgba(0, 0, 0, 0.075)`): Inputs, secondary buttons, and compact controls.
- **Dashboard Hover** (`0 0.75rem 1.5rem rgba(15, 23, 42, 0.08)`): Hover-only lift for dashboard stat cards.
- **Modal Strong** (`0 1rem 3rem rgba(0, 0, 0, 0.175)`): Dialogs and floating confirmation surfaces.

### Named Rules

**The Layered Utility Rule.** Elevation is permitted when it explains a layer: hover, dropdown, modal, or selected work surface. It is not decoration.

## 5. Components

### Buttons
- **Shape:** Gently rounded rectangular controls (0.375rem) with compact padding.
- **Primary:** Institutional Action Blue background with white text for submit, save, create, and main action flows.
- **Hover / Focus:** Slightly darker primary tone on hover; visible focus ring using blue or red for destructive actions.
- **Secondary / Ghost / Tertiary:** White or transparent surfaces with border and slate text. Use for cancel, back, filters, and non-primary actions.
- **Danger:** Critical Red background with white text for destructive actions only.

### Chips
- **Style:** Rounded pill badges with subtle background and emphasized semantic text.
- **State:** Primary badges show selection or totals; success/danger/warning badges show record state. Badge color must carry a state meaning.

### Cards / Containers
- **Corner Style:** Medium rounding for admin panels (0.5rem), larger only for modal/content shells.
- **Background:** Surface White on Workspace Background.
- **Shadow Strategy:** Resting cards may be flat with a border; actionable dashboard cards can lift on hover.
- **Border:** Use Line Grey or translucent border. Avoid thick colored side-stripe borders.
- **Internal Padding:** Dense by default (1rem), with 1.5rem only for top-level dashboard sections.

### Inputs / Fields
- **Style:** White background, Line Grey border, medium radius, compact vertical rhythm.
- **Focus:** Border and ring shift to Institutional Action Blue. Focus state must be visible against white and muted surfaces.
- **Error / Disabled:** Error uses Critical Red text/border cues; disabled uses opacity or muted surface without losing label readability.

### Navigation
- **Style, typography, default/hover/active states, mobile treatment.** Use the Phoenix sidebar/topbar pattern: icon plus label, compact row height, active state driven by route, and breadcrumbs above content. Feather icons stay at 20px. Collapse behavior should preserve access to all admin sections.

### Tables and CRUD Lists
- Dense rows, clear action columns, and visible empty states. Tables should use borders and muted backgrounds for grouping, not decorative gradients. Search and filter controls sit close to the list they affect.

### Modals
- Use modals for confirmation and focused edit flows only. Overlay is neutral gray, panel is white, radius is 0.5rem or larger, and animation is 200-300ms with opacity/transform only.

## 6. Do's and Don'ts

### Do:
- **Do** keep admin UI dense and task-first: forms, tables, breadcrumbs, and action buttons should sit where users expect them.
- **Do** use Institutional Action Blue for primary actions, selected states, and links only.
- **Do** keep card borders quiet and shadows purposeful; use Dashboard Hover only for actionable cards.
- **Do** preserve a consistent form vocabulary: same input radius, focus ring, label style, helper/error placement, and button hierarchy.
- **Do** test Uzbek/Russian/English labels for wrapping in nav, tabs, cards, and table action columns.

### Don't:
- **Don't** make the interface look like a decorative SaaS landing page.
- **Don't** use gradient text, decorative glassmorphism, or heavy color-card grids.
- **Don't** use `border-left` or `border-right` greater than 1px as a colored accent on cards, list items, callouts, or alerts.
- **Don't** invent new button, form, modal, or table styles per screen.
- **Don't** add decorative motion that does not communicate state.
- **Don't** put tiny uppercase tracked eyebrows above every admin section.
