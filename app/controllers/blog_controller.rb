class BlogController < ApplicationController
  def index
    @posts = Post.all.decorate
  end
end
