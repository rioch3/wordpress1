import $ from 'jquery';

class Search{
    //1. describe and create/initiate our object 
    constructor(){
        this.openButton = $(".js-search-trigger");
        this.closeButton = $(".search-overlay__close");
        this.searchOverlay = $(".search-overlay");
        this.events();
        alert("hello, I'm a search.");
//        document.write("hello<br><hr><hr><hr><hr><hr>");
    }

    //2.events(dispatch center)
    events(){
        this.openButton.on("click", this.openOverlay.bind(this));
        this.closeButton.on("click", this.closeOverlay.bind(this));
    }


    //3. methods
    openOverlay(){
        this.searchOverlay.addClass("search-overlay--active");
    }

    closeOverlay(){
        this.searchOverlay.removeClass("search-overlay--active");
    }


}

export default Search;