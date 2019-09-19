/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

const helpers = require('./helpers');
require('./ajax');
require('./toasts');

function cloneAndAppendListItem($listContainer, counter, idPlaceholder, requireInputs = false) {
    let $listItemCloned = cloneListItem($listContainer, counter, idPlaceholder, requireInputs);

    $listItemCloned.removeClass('d-none');
    $listItemCloned.appendTo($listContainer).slideDown(400, function () {
        $listItemCloned.find(":input:not(button):visible:first").focus();
    });

    return $listItemCloned;
}

function deleteListItem($listItem) {
    $listItem.css('min-height', 'initial');
    $listItem.slideUp("slow", function () {
        $listItem.remove();
    });
}


function cloneListItem($listContainer, counter, idPlaceholder, requireInputs = false) {
    let $listItemCloned = $listContainer.find('> li:first').clone();

    // Use negative indexes for new (cloned) items
    let newItemId = idPlaceholder.replace(/\[x]/, '[-' + counter + ']');
    let placeholderRegex = new RegExp(helpers.escapeRegEx(idPlaceholder), 'i');

    // update names, ids and label indexes

    $listItemCloned.find('*[name^="' + idPlaceholder + '"]').each(function () {
        $(this).prop('name', $(this).prop('name').replace(placeholderRegex, newItemId));
        if (requireInputs === true) {
            $(this).prop('required', true);
        }
    });

    $listItemCloned.find('*[id^="' + idPlaceholder + '"]').each(function () {
        $(this).prop('id', $(this).prop('id').replace(placeholderRegex, newItemId));
        $(this).prop('disabled', false);
    });

    $listItemCloned.find('*[for^="' + idPlaceholder + '"]').each(function () {
        $(this).prop('for', $(this).prop('for').replace(placeholderRegex, newItemId));
    });

    return $listItemCloned;
}

window.cloneAndAppendListItem = cloneAndAppendListItem;
window.deleteListItem = deleteListItem;
