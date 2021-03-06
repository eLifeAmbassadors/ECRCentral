/* global instantsearch */

function hitTemplate(hit) {
  if (hit.deadline == ''){
    deadline = 'Check website';
  }else{
    deadline = hit.deadline;
  }

  var currentDate = new Date(hit.updated_at.replace(/-/g, "/"));
  var date = currentDate.getDate();
  var month = currentDate.getMonth(); 
  var year = currentDate.getFullYear();
  var dateString = date + "-" +(month + 1) + "-" + year;

  return `
    <div>
      <article>
        <div class="post-content">
          
          <h2 class="entry-title">
            <a href="/travel-grants/${hit.slug}" rel="bookmark">
            ${hit._highlightResult.name.value}
            </a>
          </h2>
          <div class="post-excerpt">
             ${get_funder(hit.funders, hit._highlightResult.funder_name.value)}
            </a>
          </div>
            <div class="entry-meta clear">
            ${get_logo(hit.logos)}
            <div class="entry-funder-content">
              <div class="funder-name">
                 <i class="fa fa-globe"></i> Applicant nationality: ${hit.applicant_country} | 
<i class="fa fa-university"></i> Grant purpose: ${hit.travel_purpose.toString()}
              </div>
              <div class="post-date">
                <i class="fa fa-calendar-alt"></i> Deadline: ${deadline} | Last updated: ${dateString}
              </div>
              <!--
              <div class="post-meta-info">
              </div>
              -->
            </div>
          </div>
        </div>
      </article>
    </div>`;
}


function get_funder(funders, funder_name){
  if (funders != null && funders.length != 0 && funders[0] != null){
    if(funders.length > 1)
    {
        return funders.join(", ");
    }else{
      return funders;
    }
  }else{
    return funder_name;
  }

}

function get_logo(logos){
  if (logos != null && logos.length != 0 && logos[0] != null){
    if(logos.length > 1)
    {
      logos_html = '<div class="funder-gravatar">'
        for(var logo in logos)
        {
          logos_html = logos_html.concat(`<img src="/storage/${logos[logo]}" height="40">`)
        }
        return logos_html.concat('</div>');
    
    }else{
      return `<div class="funder-gravatar">
              <img src="/storage/${logos}" height="40">
          </div>`;
    }
  }else{
    logos = null;
    return " ";
  }

}



const search = instantsearch({
  appId: "2YE81QTVE3",
  apiKey: "2a1b953e25371e863ca01b363db8a686",
  indexName: "travel_grants_index",
  searchParameters: {
    hitsPerPage: 10,
    attributesToSnippet: ["content:14"],
    snippetEllipsisText: " [...]"
  }
});

// widget to add hits list.

 search.addWidget(
  instantsearch.widgets.hits({
    container: "#hits",
    templates: {
      empty: "No travel grants found.",
      item(hit) {
        return hitTemplate(hit);
      }
    }
  })
);

// widget to add a search bar.

 search.addWidget(
  instantsearch.widgets.searchBox({
    container: "#searchbox",
    placeholder: "Search travel grants",
    autofocus: false
  })
);

// widget to add search stats.

 search.addWidget(
  instantsearch.widgets.stats({
    container: "#stats",
    templates: {
      body(hit) {
        return `<i class="fab fa-searchengin"></i> <strong>${hit.nbHits}</strong> travel grants found ${
          hit.query != "" ? `for <strong>"${hit.query}"</strong>` : ``
        }</strong>`;
      }
    }
  })
);

// widget to add Funders list.

 search.addWidget(
  instantsearch.widgets.refinementList({
    container: "#funders",
    attributeName: "funder_name",
    autoHideContainer: false,
    showMore: true,
    searchForFacetValues: false,
    collapsible: true,
    limit: 5,
    templates: {
      header: "Funders"
    }
  }
  )
);

// widget to add Funders list.

 search.addWidget(
  instantsearch.widgets.refinementList({
    container: "#membership",
    attributeName: "membership",
    autoHideContainer: false,
    showMore: true,
    searchForFacetValues: false,
    collapsible: true,
    limit: 2,
    templates: {
      header: "Membership required?"
    }
  }
  )
);

// widget to add grant purpose list.

search.addWidget(
  instantsearch.widgets.refinementList({
    container: "#travel_purpose",
    attributeName: "travel_purpose",
    autoHideContainer: false,
    showMore: true,
    searchForFacetValues: false,
    collapsible: true,
    limit: 10,
    templates: {
      header: "Grant purpose"
    }
  }

  )
);


search.addWidget(
  instantsearch.widgets.refinementList({
    container: "#career_levels",
    attributeName: "career_levels",
    autoHideContainer: false,
    showMore: true,
    searchForFacetValues: false,
    collapsible: true,
    limit: 6,
    templates: {
      header: "Career level"
    }
  }

  )
);


// Uncomment the following widget to add pagination.

search.addWidget(
  instantsearch.widgets.pagination({
    container: "#pagination"
  })
);

search.start();
