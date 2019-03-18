<div class="row">
    <table class="table table-striped">
        <thead>
            <th style="width:8.33%" scope="col">ID</th>
            <th style="width:8.33;%" scope="col">Table</th>
            <th style="width:8.33;%" scope="col">Customer</th>
            <th style="width:16.66;%" scope="col">Employee</th>
            <th style="width:16.66;%" scope="col">Total</th>
            <th style="width:16.66;%" scope="col">Create At</th>
            <th style="width:16.66;%" scope="col">Check Out At</th>
            <th style="width:8.33;%" scope="col"></th>
        </thead>
        <tbody>
            <?php foreach($invoices as $invoice): ?>
                <tr>
                    <td><?php echo $invoice['id']?></td>
                    <td><?php echo $invoice['table']?></td>
                    <td><?php echo $invoice['customer']?></td>
                    <td><?php echo $invoice['employee']?></td>
                    <td><?php echo number_format($invoice['total'])?> VND</td>
                    <td><?php echo $invoice['create_at']?></td>
                    <td><?php echo $invoice['check_out_at']?></td>
                    <td>
                        <a href="<?php echo base_url('tracking/show_all_detail_invoices/'.$invoice['id']); ?>" class="btn btn-info">Detail</a>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>