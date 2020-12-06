<?php
namespace ant\moduleManager;

use Composer\Composer;
use Composer\Plugin\PluginInterface;
use Composer\IO\IOInterface;

class Plugin implements PluginInterface
{
    /**
     * @var array noted package updates.
     */
    private $_packageUpdates = [];
    /**
     * @var string path to the vendor directory.
     */
    private $_vendorDir;
	
	protected $_vendorName = 'antweb';

	protected $_moduleFilename = 'modules.php';

    /**
     * @inheritdoc
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        $installer = new Installer($io, $composer);
        $composer->getInstallationManager()->addInstaller($installer);
        $this->_vendorDir = rtrim($composer->getConfig()->get('vendor-dir'), '/');
        $file = $this->_vendorDir . '/'.$this->_vendorName.'/'.$this->_moduleFilename;
		
        if (!is_file($file)) {
            @mkdir(dirname($file), 0777, true);
            file_put_contents($file, "<?php\n\nreturn [];\n");
        }
    }
    
    public function deactivate(Composer $composer, IOInterface $io) {

    }
    
    public function uninstall(Composer $composer, IOInterface $io) {

    }
}
