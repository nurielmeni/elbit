<tr class="job-row">
    <td>
        <div class="checkbox sr-select">
            <span class="checkbox-element" id="<?= $job['jobCode'] ?>" jobcode="<?= $job['jobCode'] ?>">
                <div class="check"></div>
            </span>
            <label for="<?= $job['jobCode'] ?>"><a href="/job-details?jobcode=<?= $job['jobCode'] ?>"><?= $job['jobTitle'] ?></a></label>
        </div>
    </td>
    <td><?= $job['jobCode'] ?></td>
    <td><?= $job['regionText'] ?></td>
    <td><?= key_exists('cityName', $job) ? $job['cityName'] : '' ?>
        <a href="#" class="btn-table download" jobcode="<?= $job['jobCode'] ?>">הגשת קו"ח ></a>
    </td>
</tr>
<script>
    new Checkbox(document.getElementById('<?= $job['jobCode'] ?>'));
</script>