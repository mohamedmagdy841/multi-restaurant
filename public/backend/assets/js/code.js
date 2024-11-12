$(function(){
    $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'Deleted!',
                    'Your record has been deleted.',
                    'success'
                )
            }
        })
    });
});

$(function(){
    $(document).on('click','#confirmOrder',function(e){
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: 'Are you sure?',
            text: "Confirming This Order?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Confirm it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'Confirmed!',
                    'Your order has been Confirmed.',
                    'success'
                )
            }
        })
    });
});
$(function(){
    $(document).on('click','#processingOrder',function(e){
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: 'Are you sure?',
            text: "Processing This Order?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Processing it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'Processing!',
                    'Your order has been Processed.',
                    'success'
                )
            }
        })
    });
});
$(function(){
    $(document).on('click','#deliveredOrder',function(e){
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: 'Are you sure?',
            text: "Delivering This Order?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, deliver it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'Delivered!',
                    'Your order has been delivered.',
                    'success'
                )
            }
        })
    });
});
