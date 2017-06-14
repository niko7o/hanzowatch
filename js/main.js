function searchHero() {
    // Declare variables to make events cleaner
    var input, filter, ul, li, a, i;
    input = document.getElementById('hero-filter');
    filter = input.value.toUpperCase();
    ul = document.getElementById("hero-stats");
    li = ul.getElementsByTagName('li');

    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
        hero = li[i].getElementsByTagName("div")[0];
        if (hero.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}