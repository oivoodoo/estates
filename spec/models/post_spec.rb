require 'spec_helper'

describe Post do
  it { should validates_presence_of(:title) }
  it { should validates_presence_of(:content) }
end

