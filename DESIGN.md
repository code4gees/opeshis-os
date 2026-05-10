# Opeshis OS v4.0 | Stitch Design System Spec

## 1. Vision & Principles
**The "Modern Clinical" Aesthetic**
- **Clarity over Flash:** Clinical data must be legible under stress. Contrast is non-negotiable.
- **Layered Depth:** Use shadows and subtle background shifts (Navy-900 to Navy-700) to create hierarchy, not just borders.
- **Data Density:** High-information layouts (Epic-style) for power users, but with the clean breathing room of modern SaaS (Flatiron-style).
- **Medical Trust:** Use "Cobalt" for primary actions and "Sage" for successful/vital states.

---

## 2. Design Tokens

### A. Color Palette (The "Navy Elite" Layers)
We are moving away from flat black (`#1a1d24`) to a richer, layered Navy.

| Token | Hex | Usage |
| :--- | :--- | :--- |
| **Surface-Deep** | `#050B15` | Page Background |
| **Surface-Base** | `#0A192F` | Sidebar / Main Shell |
| **Surface-Elevated** | `#112240` | Default Card Background |
| **Surface-Overlay** | `#1D2D50` | Modals / Hovered Cards |
| **Cobalt (Primary)** | `#1B5FA8` | Buttons, Active States, Key Highlights |
| **Sage (Success)** | `#82C09A` | Vitals, Positive Trends, "In-Progress" |
| **Rose (Critical)** | `#E11D48` | Alerts, Critical Vitals, Errors |
| **Text-Primary** | `#F8FAFC` | Main headings, readable data |
| **Text-Muted** | `#94A3B8` | Labels, metadata, secondary info |

### B. Typography
- **Primary Font:** `Outfit` (Already in use, keeping as requested).
- **Scale:**
  - `Display`: 32px / 700
  - `Heading`: 18px / 600 (Semibold)
  - `Body`: 14px / 400
  - `Data-Compact`: 12px / 500 (For high-density tables)

### C. Iconography
- **Set:** `Lucide` (replacing Font Awesome for a lighter, more medical feel).
- **Size:** 18px standard for buttons; 24px for dashboard metrics.

---

## 3. Core Component Overhaul

### `cc-button`
- **Variants:**
  - `primary`: Cobalt background, white text. Subtle outer glow on hover.
  - `secondary`: Deep Navy with a thin 1px border.
  - `ghost`: Transparent, text-only with hover surface highlight.
- **Properties:** `compact` (shorter padding) for dense forms.

### `cc-card`
- **Standard:** Background `#112240`, 1px border `white/5`, rounded `xl`.
- **Interactivity:** On hover, background shifts to `#1D2D50` and border becomes `Cobalt/30`.
- **Header:** Explicit separation between title and content with a sub-pixel divider.

### `cc-table` (The "Clinician Grid")
- **Standard:** Alternating row highlights (Zebra) using `white/2`.
- **Compact:** `py-1` on cells, `text-xs` for font.
- **Headers:** Sticky headers, uppercase `text-muted` with `tracking-widest`.

---

## 4. High-Level Clinical Patterns (New)

### `cc-patient-banner`
A horizontal bar for the top of clinical screens (EMR).
- **Left:** Patient Name, Age, Sex, Medical ID.
- **Center:** Vitals Summary (Quick Glance).
- **Right:** Allergies (Critical/Rose) and Status Badge.

### `cc-vital-trend`
A specialized card for vitals.
- **Visual:** Small sparkline (Sage) next to the current value.
- **Indicators:** Small arrows for up/down trends compared to last reading.

### `cc-medical-timeline`
A vertical or horizontal track of clinical encounters.
- **Styles:** Different icons for "Admission", "Consultation", "Lab Result", and "Pharmacy Dispense".

---

## 5. Dashboard Strategy (The "Operational Intelligence" View)
- **Problem:** Current dashboard has "color collisions" and "eye strain."
- **Fix:**
  1. Remove heavy gradients from background SVGs.
  2. Use "Surface-Elevated" cards against a "Surface-Deep" background to create natural separation without borders.
  3. Standardize text colors: No white-on-white or dark-on-dark. Labels must be `Text-Muted`, Data must be `Text-Primary`.
  4. Use "Cobalt" consistently for navigation and "Sage" for positive data.

---

## 6. Implementation Checklist
1. [ ] Add `Lucide` CDN/Package.
2. [ ] Update `tailwind.config.js` with new Navy shades.
3. [ ] Refactor `cc-shell` to apply "Surface-Deep" background globally.
4. [ ] Iterate through `cc-` components.
5. [ ] Build the Patient Banner & Timeline.
6. [ ] Rewrite Dashboard layout.
