# custom-admin-pointers
Custom Admin Pointers for Wordpress

Usage:

Add a filter for "all_admin_pointers" that returns an array of pointers in the
form of associative arrays:

```
add_filter('all_admin_pointers', 'admin_pointers');

function admin_pointers() {
  return array(
    // ...
  );
}
```

Arrays can have the following keys:

| Array Key | Description |
| --------- | ----------- |
|`page_css_identifier`| a specific css selector for an element on the page the pointer should appear on|
|`click_trigger_element`| the css selector of an element that should trigger a pointer to appear|
|`css_element_anchor`| the css selector of the element that the pointer should appear by|
|`show_delay`| time in milleseconds to delay showing the pointer, in case there is an animation stopping elements from being added to the dom, etc|
|`title`| The title text that appears in the blue bar of the pointer|
|`content`| The html content inside the pointer.|
|`css_class`| an additional selector to give to the pointer in case additional pointer-specific styles need to be applied|
|`edge`| where should the arrow appear|
|`align`| what side should the pointer be relative to for the element anchor|
|`scroll`| should this element be scrolled to when it appears on screen? default: `false`.|
|`sub_pointers`| an array of pointers to appear when the current cursor closes. This is recursive - to make a chain of sequential pointers, add a sub pointer to a subpointer, etc.|
