const url = "put_your_url_or_uri_here";
const type = "POST";

$.ajax({
    url: url,
    type: type,
    success: function (response) {
        console.log(response);
    },
});