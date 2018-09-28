# WP Starter
A _very minimal_ WordPress theme to help you get started building custom sites.

## File Structure
If you're not a big fan of the way WP template & theme files are organized, here's yet another way of doing it. The function **get_template_part()** is used extensively to load the correct template. However, you still have the option to add the files the normal way to override the theme. And to help you find your way around, here's a brief explanation of the structure:

### **_src/**
Includes the SCSS and JS files that will need to be compiled during development. Use Yarn to download the dependencies. Codekit is highly recommended.

#### _src/scss/modules/
Using a kind of atomic design, these modules help with things like position, grid, and typography. It's very minimal, but extensible enough to fit your layout needs.

#### _src/scss/settings/
Mixins and variables used throughout the modules and theme.

#### _src/scss/theme/
It follows the theme folders and files to better mantain the site's styles.

### **func/**
Loads all the different functions and hooks used throughout the theme.

### **global/**
Loads default templates like 404, blog, default page, etc...

### **pages/**
Create the custom templates for pages here. Make sure you load this new file in the page.php file. For an example, see how pages/home.php is loaded. You could create templates, but sometimes you just need the layout for a specific page.

### **partials/**
Any files that load over and over throughout the site should be added here.

### **templates/**
Add your custom templates here. Samples are included.
