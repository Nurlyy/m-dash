function openurl(controller, type, start_date = null, end_date = null, candidate_id = null) {
    console.log(start_date + "gfsdgfd");
    $.ajax({
        url: '/'+controller+'/' + type + ((start_date!=null)?'?start_date=' + start_date.split(".")[2] + "-" + start_date.split(".")[1] + "-" + start_date.split(".")[0] + '&end_date=' + end_date.split(".")[2] + "-" + end_date.split(".")[1] + "-" + end_date.split(".")[0] + ((candidate_id != null) ? "&candidate_id=" + candidate_id : ""):""),
        type: 'GET',
        success: function(data) {
            // $('#page-wrapper').html("");
            history.pushState("","", "/"+controller+"/index#" + 
            type + ((start_date!=null)?'?start_date=' + 
            start_date.split(".")[2] + "-" + start_date.split(".")[1] + "-" + 
            start_date.split(".")[0] + '&end_date=' + end_date.split(".")[2] + 
            "-" + end_date.split(".")[1] + "-" + end_date.split(".")[0] + 
            ((candidate_id != null) ? "&candidate_id=" + candidate_id : ""):""));
            $('.wrapper-content').html(data);
            window.scrollTo(0, 0);

            // console.log(data);
        }
    });
}