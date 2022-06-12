<?php
session_start();

function isApplicant() : bool
{
    return isset($_SESSION['role'] ) && $_SESSION['role'] == 'applicant';
}

function isEmployer() : bool
{
    return isset($_SESSION['role'] ) && $_SESSION['role'] == 'employer';
}