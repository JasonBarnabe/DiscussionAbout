<?php if (!defined('APPLICATION')) exit();

// Copy this file to config.php and customize!
function DiscussionAboutPluginConfig() {
	$Config = [];

	// This example assumes you want to associate discussions to "articles" and additionally be able to filter discussions by "author".
	// Assumes:
	//   - An ArticleID column has been added to GDN_Discussion (a foreign key to the articles table)
	//   - The articles table consists of id, title, author_id
	//   - The authors table consists of id, name

	// Column name of the foreign key in GDN_Discussion referencing your item
	$Config['ForeignKey'] = 'ArticleID';

	// Table name for your item
	$Config['ItemTable'] = 'articles';

	// Column name of the primary key in ItemTable
	$Config['ItemPrimaryKey'] = 'id';

	// Column name in ItemTable for the display value for your item
	$Config['ItemName'] = 'title';

	// Request parameter for filtering discussions for your item and creating a new discussion for your item
	$Config['ItemParameter'] = 'article';

	// Turn the ID for an item into a URL. Return null if no URL is available.
	$Config['ItemIDToURL'] = function($ID) {
		return '/articles/'.$ID;
	};

	// Returns a string to use to describe the item when ItemName is null (e.g. there is no associated item). Return null to not render anything for the item.
	$Config['DefaultName'] = function($ID) {
		return '(Deleted item '.$ID.')';
	};

	// If the item request parameter doesn't exist when creating a new thread, set this to have a field allowing the user to specify the item.
	$Config['UserEntryLabel'] = "If you want to discuss a specific article, ignore Category above and enter the article's URL here:<br>";

	// Turn the user's item entry when creating a new thread into an item ID. Return null to not set the item ID.
	$Config['UserEntryToID'] = function($Value) {
		preg_match('/https?:\/\/example\.com\/articles\/([0-9]+).*/', $Value, $Matches);
		if (count($Matches) != 2) {
			return null;
		}
		return $Matches[1];
	};

	// Force any discussion with an item to a specific category. Null to not do that.
	$Config['ForceToCategoryID'] = null;

	// Additional possible filters.
	// parameter_name => [
	//   filter_column => (Column in ItemTable to filter by.)
	//   filter_sql => (Function to make changes to the query - for when it's more complicated than juts a single WHERE. Arguments are a Vanilla SQL object and the value to filter by.
	//   index_title_sql => (Function that loads a portion of the resulting page's title. The only argument a Vanilla SQL object; this object should be used to include the "name" of the filter in the query. Your item's table name will be aliased as "discussionaboutitem". Do apply the Where - this is done separately. Return an array of [ColumnName, FormatString], where FormatString is something like "by %s", which is the text that will be added to the title of the page.
	//   dont_respect_followed_categories => If true, when the filter is applied, ignore the user's followed categories setting and show discussions from all categories.
	// ]
	$Config['AdditionalFilters'] = [
		'author' => [
			'filter_column' => 'author_id',
			'index_title_sql' => function($SQL) {
				$ColumnName = 'DiscussionAboutItemAuthorName';
				$SQL->Select('authors.name', '', $ColumnName);
				$SQL->Join('authors', 'authors.id = discussionaboutitem.author_id', 'left');
				return [$ColumnName, 'on articles by %s'];
			}
		]
	];

	return $Config;
};
?>
