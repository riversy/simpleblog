<?php

class Antonsbox_Simpleblog_Model_Api2_Restapi_Rest_Guest_V1
    extends Antonsbox_Simpleblog_Model_Api2_Restapi
{
//    public function _retrieveCollection()
//    {
//        //get order Collection
//        return $res;
//    }
//
//    public function _multiUpdate($data)
//    {
//        //do all the business logic magic in here.
//
//        $this->_successMessage('OK', Mage_Api2_Model_Server::HTTP_OK, array('item' => $result));
//        if ($error) {
//            $this->_errorMessage('Orders not found', Mage_Api2_Model_Server::HTTP_NOT_FOUND, array('item' => $error));
//        }
//    }

//    protected function _retrieve()
//    {
//        $registryCollection = Mage::getModel('simpleblog/post')->getCollection();
//        return $registryCollection;
//    }


    public function _retrieve(array $data)
    {


        return json_encode('YEEES!!! It`s a _retrive!!');
    }

    public function _retrieveCollection()
    {
        $collection = Mage::getModel("simpleblog/post")->getCollection()->load();
        $collection->setOrder('created', 'DESC');
        $outputArray = array();
        foreach ($collection as $item) {
            $postId = $item->getId();
            $title = $item->getTitle();
            $content = $item->getContent();
            $created = $item->getCreated();

            $post_to_encode = array();
            $post_to_encode[] = array(
                'id' => $postId,
                'name' => $title,
                'content' => $content,
                'created' => $created);
            array_push($outputArray, $post_to_encode);
        }
        $ecoded_data = json_encode($outputArray);
        return $ecoded_data;
    }

    public function _delete(array $data)
    {
        return json_encode('YEEES!!! It`s a _delete!!');
    }

    public function _update(array $data)
    {
        return json_encode('YEEES!!! It`s a _update!!');
    }


    public function _create(array $data)
    {
//        $postId = $data['id'];
//        $postTitle = $data['title'];
//        $postContent = $data['content'];
//        $postCreated = $data['created'];

        $post = Mage::getModel("simpleblog/post");

//        $post->setId($postId);
//        $post->setTitle($postTitle);
//        $post->setContent($postContent);
        $currentTimestamp = Mage::getModel('core/date')->timestamp(time());
        $post->setCreated(date('Y-m-d H:i:s', $currentTimestamp));
        $post->setTitle('From API');
        $post->setContent('CONTENT FROM API');
        $post->save();

        return $this->_getLocation($post);
    }
}