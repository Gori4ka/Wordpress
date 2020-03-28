<?php

function breaking_news_settings_page()
{
    add_settings_section("section", "Section", null, "breaking_news");
    add_settings_field("breaking-news", "Breaking news", "demo_checkbox_display", "breaking_news", "section");
    register_setting("section", "breaking-news");
}

function demo_checkbox_display()
{
   ?>
        <!-- Here we are comparing stored value with 1. Stored value is 1 if user checks the checkbox otherwise empty string. -->
        <input type="checkbox" name="breaking-news" value="1" <?php checked(1, get_option('breaking-news'), true); ?> />
   <?php
}

add_action("admin_init", "breaking_news_settings_page");

function breaking_news_page()
{
  ?>
      <div class="wrap">
         <h1>Demo</h1>

         <form method="post" action="options.php">
            <?php
               settings_fields("section");

               do_settings_sections("breaking_news");

               submit_button();
            ?>
         </form>
      </div>
   <?php
}

function menu_item()
{
  add_submenu_page("options-general.php", "Breaking news", "Breaking news", "manage_options", "demo", "breaking_news_page");
}

add_action("admin_menu", "menu_item");
