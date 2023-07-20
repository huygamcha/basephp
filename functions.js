function deleteItem(id, tableName) {
    if (confirm("Bạn có muốn xóa không?")) {
        var that = $(this);
        $.ajax({
            url: 'delete.php?table_name=' + tableName + '&id=' + id,
            // nếu trả về thành công thì sẽ xoá
            success: function (data) {
                console.log($(that).parents('tr'));
                $(that).parents('tr').remove();
            }
        })
    }
}
