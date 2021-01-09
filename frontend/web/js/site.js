$('document').ready(() => {

    $(".btn-cart").click(($event) => {

        const $this = $($event.target);
        $event.preventDefault();
        const productId = parseInt($this.attr('id'), 10);
        $.ajax({
            method: "POST",
            url: $this.attr('href'),
            data: JSON.stringify({productId}),
            success: (result)=>{
                $("#cartItemCount").text(result["itemsCount"]);
            },
            error: (e)=>{
                console.log("ERROR : ", e);
            //    Show a failure alert;
            }
        })
    });
})