<?php

/**
 * Calculates the match percentage between two arrays of skills.
 *
 * @param array $skills_1 An array of skills.
 * @param array $skills_2 An array of skills.
 *
 * @return int The match percentage as an integer.
 */
function calculate_match_percentage( $skills_1, $skills_2 ) {
    // Find the skills that both users have.
    $matched_skills = array_intersect( $skills_1, $skills_2 );

    // Calculate the match percentage as a rounded percentage.
    $all_skills = array_unique( array_merge( $skills_1, $skills_2 ) );
    $match_percentage = round( count( $matched_skills ) / count( $all_skills ), 2 ) * 100;

    return $match_percentage;
}
