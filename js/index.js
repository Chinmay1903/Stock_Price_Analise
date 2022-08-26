$("#fileupload").change(function() {
    var $this = $(this);
    var arr = $this[0].value.split("\\");
    console.log(arr[arr.length-1]);
    $this[0].parentNode.dataset.text = arr[arr.length-1];
});
$('.btn').on('click', function() {
    var $this = $(this);
    $this.button('loading');
});