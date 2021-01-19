let searchField = $('#searchCatalogAuthors');
let dropDownList = $('#dropDownSelectList');
let authorsList = $('#authorsList');
let authorsListSelect = $('#authorsListSelect');
for (const authorOption of authorsListSelect.children()) {
    // console.log(authorOption);
    addAuthorToTheUserList(authorOption.value, authorOption.text);
}
searchField.on('input', function (params) {
    // dropDownList.get(0).hidden = false;
    dropDownList.show();
    findAuthors(params.currentTarget.value);

    // console.log(params);
})

function findAuthors(keyword) {
    $.ajax('/authors?AuthorSearch[keyword]=' + encodeURI(keyword), {
        headers: {
          'Accept': 'application/json',
        },
        success: function (data, status, xhr) {
            dropDownList.empty()
            // dropDownList.find('option').remove.end();
            for (const author of data) {
                let authorName = `${author.first_name} ${author.last_name} ${author.patronymic}`;
                if (getAddedAuthor(author.id).length > 0) {
                    continue;
                }
                dropDownList.append(
                    `<li value="${author.id}" class="list-group-item d-flex justify-content-between">
                        <p class="m-0">${_.escape(authorName)}</p>
                        <a class="text-decoration-none" onclick="addAuthorToTheList(${author.id}, '${escape(authorName)}')">Add</a>
                    </li>`
                );
            }
        },

    })
}

function getAddedAuthor(id) {
    return authorsListSelect.find(`option[value="${id}"]`);
}
function addAuthorToTheSelectList(id,name) {
    authorsListSelect.append(`<option value="${id}">${_.escape(unescape(name))}</option>`)
        .find(`option[value="${id}"]`)
        .get(0)
        .selected = true;
}

function addAuthorToTheUserList(id,name) {
    authorsList.append(
        `<li value="${id}" class="list-group-item d-flex">
            <p class="m-0">${_.escape(unescape(name))}</p>
            <a onclick="deleteAuthorFromTheList(${id})" class="ml-auto text-danger text-decoration-none">Delete</a>
        </li>`
    );
}


function addAuthorToTheList(id, name) {
    if (getAddedAuthor(id).length > 0) {
        console.log( "This element already exists")
        return false;
    }
    addAuthorToTheSelectList(id,name);
    addAuthorToTheUserList(id,name);

    dropDownList.find(`li[value="${id}"]`)
        .find('a')
        .text('Added')
        .removeAttr('onclick')
        .addClass('text-success')

    return true;
}

function deleteAuthorFromTheList(id) {
    authorsList.find(`li[value="${id}"]`).remove();
    authorName = getAddedAuthor(id).remove().text()
    // console.log(`Deleting autho: ${authorName}`)
    let authorSearch = dropDownList.find(`li[value="${id}"]`);
    if (authorSearch.length > 0) {
        // console.log(authorSearch);
        authorSearch.find('a')
            .text('Add')
            .removeClass('text-success')
            .attr('onclick', `addAuthorToTheList(${id}, '${escape(authorName)}')`)
    }


    // console.log(`Deleting author with id: ${id}`);
}
