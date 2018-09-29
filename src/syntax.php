<?php
/**
 * DokuWiki Plugin mark2memorize (Syntax Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  shimamu <cooklecurry@gmail.com>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) {
	die();
}

class syntax_plugin_mark2memorize extends DokuWiki_Syntax_Plugin
{
	/**
	 * @return string Syntax mode type
	 */
	public function getType()
	{
		return 'formatting';
	}

	/**
	 * @return string Paragraph type
	 */
	public function getPType()
	{
		return 'normal';
	}

	function getAllowedTypes() { return array('formatting', 'substition', 'disabled'); }

	/**
	 * @return int Sort order - Low numbers go before high numbers
	 */
	public function getSort()
	{
		return 100;
	}

	/**
	 * Connect lookup pattern to lexer.
	 *
	 * @param string $mode Parser mode
	 */
	public function connectTo($mode)
	{
		$this->Lexer->addEntryPattern('<markmemo.*?>(?=.*?</markmemo>)', $mode, 'plugin_mark2memorize');
	}

	public function postConnect()
	{
		$this->Lexer->addExitPattern('</markmemo>', 'plugin_mark2memorize');
	}

	/**
	 * Handle matches of the mark2memorize syntax
	 *
	 * @param string       $match   The match of the syntax
	 * @param int          $state   The state of the handler
	 * @param int          $pos     The position in the document
	 * @param Doku_Handler $handler The handler
	 *
	 * @return array Data for the renderer
	 */
	public function handle($match, $state, $pos, Doku_Handler $handler)
	{
		switch ($state) {
		case DOKU_LEXER_ENTER :     return array($state, '');
		case DOKU_LEXER_UNMATCHED : return array($state, $match);
		case DOKU_LEXER_EXIT :      return array($state, '');
		}
		return array();
	}

	/**
	 * Render xhtml output or metadata
	 *
	 * @param string        $mode     Renderer mode (supported modes: xhtml)
	 * @param Doku_Renderer $renderer The renderer
	 * @param array         $data     The data from the handler() function
	 *
	 * @return bool If rendering was successful.
	 */
	public function render($mode, Doku_Renderer $renderer, $data)
	{
		if ($mode == 'xhtml') {
			list($state, $match) = $data;
			switch ($state) {
			case DOKU_LEXER_ENTER :      
				$renderer->doc .= "<span class='hide' onclick='showAnswer(this);'>"; 
				break;
			case DOKU_LEXER_UNMATCHED :  $renderer->doc .= $renderer->_xmlEntities($match); break;
			case DOKU_LEXER_EXIT :       $renderer->doc .= "</span>"; break;
			}
			return true;
		}
		return false;
	}
}
?>
