<div class="row">
    <table class="table table-striped">
        <thead>
            <th style="width:8.33%" scope="col">ID</th>
            <th style="width:8.33;%" scope="col">Product</th>
            <th style="width:8.33;%" scope="col">Quantity</th>
            <th style="width:16.66;%" scope="col">Total</th>
            <th style="width:16.66;%" scope="col">Status</th>
            <th style="width:16.66;%" scope="col">Delete At</th>
        </thead>
        <tbody>
            <?php foreach($detail_invoices as $detail_invoice): ?>
                <tr>
                    <td><?php echo $detail_invoice['id']?></td>
                    <td><?php echo $detail_invoice['product']?></td>
                    <td><?php echo $detail_invoice['quantities']?></td>
                    <td><?php echo number_format($detail_invoice['total']);?> VND</td>
                    <td><?php echo $detail_invoice['status']?></td>
                    <td><?php echo $detail_invoice['deleted_at']?></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <div class="col-md-12">
        <a href="<?php echo base_url('tracking/show_all_invoices'); ?>" class="btn btn-warning">Back to tracking invoices</a>
    </div>
</div>