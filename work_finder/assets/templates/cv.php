<?php

function shortDocument($title,$salary,$currency,$schedule,$experience,$description, $id=0, $company=null) : string
{
    $doc = <<<doc
<div class="card">
    <div class="doc-card-header">
        <h3>$title</h3>
        <p class="ml-2">$salary $currency</p>
    </div>
doc;
    if (!empty($company))
        $doc .= "<div>
        <p>$company</p>
    </div>";
    $doc .= <<<doc
        <div>
            <p class="mb-1">Опыт: $experience</p>
            <p class="m-0">$schedule</p>
        </div>
        <div class="about">
            <p class="mt-2 mb-0">Описание:</p>  
            <pre class="m-0">$description</pre>
        </div>
doc;
    if ($id > 0)
        $doc .=  <<<doc
            <form class="mt-3" action="send.php" method="post">
                <input type="text" name="remove_id" value="$id" hidden>
                <input class="form-control btn btn-warning w-25" type="submit" value="Удалить" name="delete">
            </form>
doc;
    $doc.="</div>";

    return $doc;
}

function document($title,$salary,$currency,$schedule,$experience,$description, $last_name, $first_name, $patronymic,
$ed_level, $ed_institution, $ed_department, $ed_specialization, $ed_year)
{
    $doc = <<<doc
    <div class="card">
        <div class="doc-card-header">
            <h3>$title</h3>
            <p class="ml-2">$salary $currency</p>
       </div>
        <div>
            <p class="mb-1">Опыт: $experience лет</p>
            <p class="m-0">$schedule</p>
        </div>
        <div class="about">
            <p class="mt-3">Описание</p>  
            <pre class="m-0">$description</pre>
        </div>
        <div class="personal">
            <h4 class="m-0 mt-3">$last_name $first_name $patronymic</h4>
            <table class="education">
                <tr>
                    <td>Уровень образования:</td>
                    <td>$ed_level</td>
                </tr>
                <tr>
                    <td>Учебное заведение:</td>
                    <td>$ed_institution</td>
                </tr>
                <tr>
                    <td>Факультет:</td>
                    <td>$ed_department</td>
                </tr>
                <tr>
                    <td>Специальность:</td>
                    <td>$ed_specialization</td>
                </tr>
                <tr>
                    <td>Год окончания:</td>
                    <td>$ed_year</td>
                </tr>
            </table>

        </div>
    </div>
doc;
/*    <p class="m-0">$ed_level</p>
    <p class="m-0">$ed_institution</p>
    <p class="m-0">$ed_department</p>
    <p class="m-0">$ed_specialization</p>
    <p class="m-0">$ed_year</p>*/
    return $doc;
}

function getCVShort($title,$salary,$currency,$schedule,$experience,$description, $id = 0)
{
    return shortDocument($title,$salary,$currency,$schedule,$experience,$description, $id);
}
function getVacancy($title,$salary,$currency,$schedule,$experience,$description, $company) : string
{
    return shortDocument($title,$salary,$currency,$schedule,$experience,$description, $company);
}
function getCV($title,$salary,$currency,$schedule,$experience,$description, $last_name, $first_name, $patronymic,
               $ed_level, $ed_institution, $ed_department, $ed_specialization, $ed_year)
{
    document($title,$salary,$currency,$schedule,$experience,$description, $last_name, $first_name, $patronymic,
        $ed_level, $ed_institution, $ed_department, $ed_specialization, $ed_year);
}