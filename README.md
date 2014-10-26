[DiscussionAbout](http://vanillaforums.org/addon/discussionabout-plugin-1.0) is a [Vanilla Forums](http://vanillaforums.org/) plugin that lets you associate Vanilla discussions to a non-Vanilla item in your database of your choosing. For example, if you have "articles" in your database users can:

- Create a discussion about an article by visiting /yourforum/post/?article=123.
- See in the recent discussions list, category discussions list, and individual discussion page which article each discussion is about (with the article's title!)
- See a list of discussions about an article by visiting /yourforum/?article=123, or see a list of discussions about an article by a particular author by visiting /yourforum/?author=456.

[See a live example!](https://greasyfork.org/forum/)

## Requirements

- Vanilla 2.1

## Installation

1. Add a foreign key to GDN_Discussion pointing to the table containing the items you want to have discussions about.
2. Install the plugin (but don't enable yet!)
3. In the plugin's folder, copy config-example.php to config.php.
4. Edit the configuration in config.php. The relevant documentation is in there.
5. Enable the plug-in.

## Donations

If you like DiscussionAbout, consider making a donation. Suggested amount is $5.

* [Donate by PayPal or credit card](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=jason.barnabe@gmail.com&item_name=Contribution+for+User+Agent)
* Donate BitCoin to 1L12TQTtDECrbbqWDZmnM69bfuJUVFVr6v

## License

DiscussionAbout is licensed under [GPLv3](http://www.gnu.org/copyleft/gpl.html).
