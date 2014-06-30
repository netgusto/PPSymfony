<?php

namespace Pulpy\CoreBundle\Command;

use Symfony\Component\Console\Helper\DialogHelper,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Output\OutputInterface,
    Symfony\Component\Console\Input\InputArgument,
    Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

use Pulpy\Core\Entity\Post;

class PostUpdateCacheCommand extends ContainerAwareCommand {
    
    protected function configure() {
        $this
            ->setName('pulpy:cache:update')
            ->setDescription('Updates the post cache');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $this->getContainer()->get('post.cachehandler')->updateCache($output);
    }
}