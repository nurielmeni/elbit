<tr class="job-row">
    <td>
        <div class="checkbox sr-select">
            <input type="checkbox" id="<?= $job['jobCode'] ?>" jobcode="<?= $job['jobCode'] ?>" name="<?= $job['jobCode'] ?>" value="<?= $job['jobTitle'] ?>">
            <label for="<?= $job['jobCode'] ?>"><span><?= $job['jobTitle'] ?></span></label>
        </div>
    </td>
    <td><?= $job['jobCode'] ?></td>
    <td><?= $job['regionText'] ?></td>
    <td><?= key_exists('cityName', $job) ? $job['cityName'] : '' ?>
        <a href="#" class="btn-table download" jobcode="<?= $job['jobCode'] ?>">הגשת קו"ח ></a>
    </td>
</tr>
