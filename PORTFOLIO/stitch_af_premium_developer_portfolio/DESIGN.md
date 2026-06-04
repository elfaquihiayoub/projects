---
name: Ayoub Elfaquihi Portfolio Identity
colors:
  surface: '#0e1416'
  surface-dim: '#0e1416'
  surface-bright: '#343a3c'
  surface-container-lowest: '#090f11'
  surface-container-low: '#161d1e'
  surface-container: '#1a2122'
  surface-container-high: '#242b2d'
  surface-container-highest: '#2f3638'
  on-surface: '#dde4e5'
  on-surface-variant: '#bbc9cd'
  inverse-surface: '#dde4e5'
  inverse-on-surface: '#2b3233'
  outline: '#859397'
  outline-variant: '#3c494c'
  surface-tint: '#2fd9f4'
  primary: '#8aebff'
  on-primary: '#00363e'
  primary-container: '#22d3ee'
  on-primary-container: '#005763'
  inverse-primary: '#006877'
  secondary: '#bcc7de'
  on-secondary: '#263143'
  secondary-container: '#3e495d'
  on-secondary-container: '#aeb9d0'
  tertiary: '#ffd6a3'
  on-tertiary: '#462b00'
  tertiary-container: '#ffb13b'
  on-tertiary-container: '#6e4600'
  error: '#ffb4ab'
  on-error: '#690005'
  error-container: '#93000a'
  on-error-container: '#ffdad6'
  primary-fixed: '#a2eeff'
  primary-fixed-dim: '#2fd9f4'
  on-primary-fixed: '#001f25'
  on-primary-fixed-variant: '#004e5a'
  secondary-fixed: '#d8e3fb'
  secondary-fixed-dim: '#bcc7de'
  on-secondary-fixed: '#111c2d'
  on-secondary-fixed-variant: '#3c475a'
  tertiary-fixed: '#ffddb5'
  tertiary-fixed-dim: '#ffb957'
  on-tertiary-fixed: '#2a1800'
  on-tertiary-fixed-variant: '#643f00'
  background: '#0e1416'
  on-background: '#dde4e5'
  surface-variant: '#2f3638'
typography:
  h1:
    fontFamily: Sora
    fontSize: 4rem
    fontWeight: '700'
    lineHeight: '1.1'
    letterSpacing: -0.02em
  h2:
    fontFamily: Sora
    fontSize: 2.5rem
    fontWeight: '600'
    lineHeight: '1.2'
    letterSpacing: -0.01em
  h3:
    fontFamily: Sora
    fontSize: 1.5rem
    fontWeight: '600'
    lineHeight: '1.4'
    letterSpacing: '0'
  body-lg:
    fontFamily: Inter
    fontSize: 1.125rem
    fontWeight: '400'
    lineHeight: '1.7'
    letterSpacing: '0'
  body-md:
    fontFamily: Inter
    fontSize: 1rem
    fontWeight: '400'
    lineHeight: '1.6'
    letterSpacing: '0'
  label-caps:
    fontFamily: Inter
    fontSize: 0.75rem
    fontWeight: '600'
    lineHeight: '1'
    letterSpacing: 0.1em
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  unit: 4px
  container-max: 1280px
  gutter: 24px
  section-padding: 120px
  stack-sm: 8px
  stack-md: 16px
  stack-lg: 32px
---

## Brand & Style

The design system is built for a high-end developer persona, balancing technical precision with premium aesthetic appeal. It targets sophisticated tech recruiters and potential high-value clients who value attention to detail and modern engineering standards.

The style is a fusion of **Minimalism** and **Glassmorphism**. It relies on ample whitespace and a restricted color palette to ensure content remains the focal point, while utilizing translucent layers and cyan glow effects to create a sense of depth and "digital luminescence." The interface should feel like a high-performance dashboard—clean, responsive, and ethereal.

**Visual Principles:**
- **Atmospheric Depth:** Using backdrop blurs to create a multi-layered interface.
- **Precision Typography:** Large, airy headlines paired with highly readable body text.
- **Luminous Accents:** Cyan is used sparingly as a "light source" to guide the eye toward interactive elements.

## Colors

The color system is optimized for a "Dark Mode First" experience to emphasize the premium developer aesthetic. 

- **Dark Mode:** Utilizes a deep navy base to provide infinite depth. The Cyan glow (#22D3EE) acts as the primary interactive signal, cutting through the charcoal secondary surfaces.
- **Light Mode:** Shifts to a crisp white foundation. The Cyan accent becomes slightly denser (#06B6D4) to maintain accessibility against the white and soft gray (#F8FAFC) backgrounds.

Transitions between modes should be handled via a smooth 300ms CSS transition on background and text properties. Use the `accent_glow` for box-shadows and radial gradients behind key components to simulate a neon-backlit effect.

## Typography

The typography strategy leverages **Sora** for its geometric, modern personality in headings, creating a distinctive architectural look. **Inter** is used for all functional and body text due to its exceptional readability and neutral "system" feel.

- **Headlines:** Use Sora with tighter letter-spacing for large displays.
- **Body:** Use Inter with generous line heights to ensure long-form project descriptions remain approachable.
- **Labels:** Small caps with increased letter spacing are reserved for category tags, breadcrumbs, and section overlines.

## Layout & Spacing

This design system employs a **12-column fixed grid** for desktop, transitioning to a fluid single-column layout for mobile devices. 

- **Grid:** 12 columns with a 24px gutter. The maximum container width is capped at 1280px to maintain line-length integrity.
- **Rhythm:** An 8px linear scale drives all spacing decisions. Large-scale section padding (120px+) is used to create "breathing room" between major portfolio projects.
- **Navbar:** A sticky, transparent navbar with a `12px` backdrop-blur and a bottom border of `1px solid rgba(255,255,255,0.1)`.

## Elevation & Depth

Depth is established through transparency and blur rather than traditional heavy shadows.

- **Glass Layers:** Use a background color with 60-80% opacity combined with a `backdrop-blur: 12px`.
- **Borders:** "Ghost borders" (1px solid with low opacity) define shapes. In dark mode, use `white/10%`; in light mode, use `black/5%`.
- **Glows:** Primary interactive cards should have a subtle Cyan outer glow (`0px 0px 20px rgba(34, 211, 238, 0.15)`) when hovered, simulating the component lifting closer to the light source.
- **Shadows:** Use extra-diffused, low-opacity shadows (e.g., `0 20px 40px -10px rgba(0,0,0,0.3)`) for top-level floating elements like modals or dropdowns.

## Shapes

The shape language is refined and approachable. 
- **Standard Radius:** 0.5rem (8px) for small components like inputs and small buttons.
- **Large Radius:** 1rem (16px) for cards and container sections.
- **Logo:** The "AF" Monogram should be constructed using geometric paths—clean, thick strokes with sharp intersections balanced by soft outer curves to mirror the typography.

## Components

### Buttons
- **Primary:** Solid Cyan background with dark text. No border. On hover, increase brightness and add a cyan glow.
- **Secondary:** Transparent background with a 1px cyan border. On hover, fill with 10% cyan opacity.
- **Interaction:** All buttons should have a `200ms ease-out` transition on background and transform (slight scale up of 1.02).

### Cards (Project/Service)
- **Style:** Glassmorphic base. Subtle 1px border.
- **Hover State:** Border color shifts to solid Cyan, and the background blur increases slightly.

### Inputs & Forms
- **Style:** Charcoal secondary background (Dark Mode) or Soft Gray (Light Mode).
- **Focus State:** 1px Cyan border with a 4px soft cyan outer ring.

### Navigation
- **Sticky Navbar:** Blur effect is critical. The logo (AF Monogram) stays on the left, with links on the right using the `label-caps` typography style.

### Decorative Elements
- **Cyan Glow Orbs:** Large, blurry radial gradients (300px-500px wide) placed behind content sections at 5% opacity to create atmospheric depth.