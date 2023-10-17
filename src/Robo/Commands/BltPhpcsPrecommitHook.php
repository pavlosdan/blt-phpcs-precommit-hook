<?php

namespace Acquia\BltPhpcsPrecommitHook\Robo\Commands\Commands;

use Acquia\Blt\Robo\BltTasks;
use Acquia\Blt\Robo\Exceptions\BltException;

class BltPhpcsPrecommitHook extends BltTasks {

  /**
   * This will be called after the pre-commit command.
   *
   * @hook post-command internal:git-hook:execute:pre-commit
   */
  public static function preCommit($changed_files): void {
    try {
      $this->invokeCommand('validate:phpcs');
    } catch (BltException $e) {
      $this->yell('Your code has failed pre-commit validation.', 40, 'red');
      return 1;
    }

    $this->say("<info>Your local code has passed git pre-push validation.</info>");
  }

}
